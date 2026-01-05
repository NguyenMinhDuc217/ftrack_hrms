<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\Image;
use App\Models\JobArea;
use App\Models\JobHrms;
use App\Models\Organization;
use App\Models\Profession;
use App\Models\Province;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminJobController extends Controller
{
    private $statuses;

    public function __construct()
    {
        $this->statuses = [
            '1' => [
                'lang' => __('default.txt_active'),
                'color' => 'bg-light-success',
            ],
            '0' => [
                'lang' => __('default.txt_inactive'),
                'color' => 'bg-light-danger',
            ],
        ];
    }

    public function index()
    {
        $user = auth()->guard()->user();

        $jobs = JobHrms::whereNull('deleted_at')->paginate(10);

        return view('admin.job.index', ['jobs' => $jobs, 'statuses' => $this->statuses]);
    }

    public function create()
    {
        $professions = Profession::where('status', 'active')->get();
        $provinces = Province::all();
        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();
        $organizations = Organization::active()->get();

        $data['breadcrumbs'] = [
            ['label' => __('role.heading_title_create'), 'url' => route('admin.role.index')],
            ['label' => __('role.create')], // Use a more general 'create' key for the last breadcrumb
        ];

        $action = 'create';

        return view(
            'admin.job.form',
            [
                'action' => $action,
                'professions' => $professions,
                'provinces' => $provinces,
                'employment_types' => $employment_types,
                'organizations' => $organizations,
                'data' => $data,
            ]
        );
    }

    public function show($job_id)
    {
        $job = JobHrms::with('profession')->with('job_area', 'job_area.province')->findOrFail($job_id);
        $organizations = Organization::active()->get();
        // dd($job->images());

        $breadcrumbs = [
            ['label' => __('job.txt_edit_job'), 'url' => route('admin.jobs.index')],
            ['label' => 'Edit Job: '."{$job->job_id} - {$job->title}", 'url' => route('admin.jobs.show', $job_id)],
        ];

        $professions = Profession::where('status', 'active')->get();
        $provinces = Province::all();
        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();

        return view(
            'admin.job.form',
            [
                'action' => 'edit',
                'breadcrumbs' => $breadcrumbs,
                'job' => $job,
                'professions' => $professions,
                'provinces' => $provinces,
                'employment_types' => $employment_types,
                'organizations' => $organizations,
            ]
        );
    }

    public function update(JobPostRequest $request, ?JobHrms $job, ImageService $imageService): RedirectResponse
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // ADD
            if (empty($job->job_id)) {
                $province_ids = $data['province_id'];
                unset($data['province_id']);
                unset($data['image_ids']);
                $job = JobHrms::create($data);

                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    $existing_images = $request->input('existing_images', []);
                    $image_ids = [];
                    foreach ($images as $image) {

                        $new_image = new Image([
                            'name' => $image->getClientOriginalName(),
                            'type' => 'job',
                            'file_name_original' => $image->getClientOriginalName(),
                            'size' => $image->getSize(),
                            'mime_type' => $image->getMimeType(),
                            'status' => 1,

                        ]);
                        $file = $imageService->upload($image, $new_image, 'jobs');
                        $image_ids[] = $file->id;
                    }
                    if ($existing_images) {
                        $image_ids = array_merge($image_ids, $existing_images);
                    }
                    $job->image_ids = $image_ids;
                    $job->save();
                }

                if ($province_ids) {
                    foreach ($province_ids as $province_id) {
                        JobArea::create([
                            'job_id' => $job->job_id,
                            'province_id' => $province_id,
                            'headcount' => $data['headcount'], // Tạm thời lưu chung cho tất cả area
                        ]);
                    }
                }

                DB::commit();

                return redirect()->route('admin.jobs.index')->with('success', 'Job added successfully.');
            } else { // EDIT
                $province_ids = $data['province_id'];

                if ($province_ids) {
                    // đang lấy những province.id của nhưng job_area status = active (chưa làm trường hợp nếu province_id mới thêm trùng với province_id cũ nhưng bị inactive)
                    $current_provinces = $job->job_area->pluck('province.id')->toArray();
                    $new_provinces = array_diff($province_ids, $current_provinces);
                    $deleted_provinces = array_diff($current_provinces, $province_ids);

                    if ($deleted_provinces) {
                        foreach ($deleted_provinces as $deleted_province) {
                            $job->job_area()->where('province_id', $deleted_province)->delete();
                        }
                    }
                    if ($new_provinces) {
                        foreach ($new_provinces as $new_province) {
                            $job->job_area()->create([
                                'province_id' => $new_province,
                                'headcount' => $data['headcount'],
                            ]);
                        }
                    }
                    if ($current_provinces) {
                        foreach ($current_provinces as $current_province) {
                            $job->job_area()->where('province_id', $current_province)->update([
                                'headcount' => $data['headcount'],
                            ]);
                        }
                    }
                }

                $job = JobHrms::where('job_id', $job->job_id)->first();
                unset($data['province_id'], $data['headcount']);
                $job->update($data);

                // Handle Avatar Upload
                $new_image_ids = [];
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    foreach ($images as $image) {

                        $new_image = new Image([
                            'name' => $image->getClientOriginalName(),
                            'type' => 'job',
                            'file_name_original' => $image->getClientOriginalName(),
                            'size' => $image->getSize(),
                            'mime_type' => $image->getMimeType(),
                            'status' => 1,

                        ]);
                        $file = $imageService->upload($image, $new_image, 'jobs');
                        $new_image_ids[] = $file->id;
                    }
                }

                $existing_images = [];
                if ($request->has('existing_images')) {
                    $existing_images = $request->input('existing_images', []);
                }
                $image_ids = array_merge($new_image_ids, $existing_images);
                $current_image_ids = $job->image_ids;
                if ($current_image_ids && $image_ids) { // delete image not in list new
                    foreach ($current_image_ids as $image_id) {
                        if (! in_array($image_id, $image_ids)) {
                            $imageService->deletebyId($image_id);
                        }
                    }
                }
                $job->image_ids = $image_ids;
                $job->save();

                DB::commit();

                return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.jobs.index')->with('error', 'Job update failed: '.$e->getMessage());
        }
    }

    public function delete($job_id, ImageService $imageService): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $job = JobHrms::where('job_id', $job_id)->first();
            if (! $job) {
                return redirect()->route('admin.jobs.index')->with('error', 'Job not found.');
            }
            $image_ids = $job->image_ids;
            $job->delete();
            $job->job_area()->delete();
            foreach ($image_ids as $image_id) { // TẠM THỜI XÓA LUÔN TRÊN SERVER
                $image = Image::find($image_id);
                if ($image) {
                    $image->delete();
                    $imageService->deletebyId($image_id);
                }
            }
            DB::commit();

            return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.jobs.index')->with('error', 'Job delete failed: '.$e->getMessage());
        }
    }
}
