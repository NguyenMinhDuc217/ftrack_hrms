<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\Department;
use App\Models\JobArea;
use App\Models\JobHrms;
use App\Models\Profession;
use App\Models\Province;
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
        $departments = Department::where('status', 'active')->get();
        $provinces = Province::all();
        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();
        $data['breadcrumbs'] = [
            ['label' => __('role.heading_title_create'), 'url' => route('admin.role.index')],
            ['label' => __('role.create')], // Use a more general 'create' key for the last breadcrumb
        ];

        $action = 'create';

        return view(
            'admin.job.form',
            [
                'action' => $action,
                'departments' => $departments,
                'provinces' => $provinces,
                'employment_types' => $employment_types,
                'data' => $data,
            ]
        );
    }

    public function show($job_id)
    {
        $job = JobHrms::with('profession')->with('job_area', 'job_area.province')->findOrFail($job_id);
        // dd($job);

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
            ]
        );
    }

    public function update(JobPostRequest $request, ?JobHrms $job = null): RedirectResponse
    {
        $data = $request->validated();

        // ADD
        if (! $job) {
            $province_ids = $data['province_id'];
            unset($data['province_id']);
            $job = JobHrms::create($data);

            if ($province_ids) {
                foreach ($province_ids as $province_id) {
                    JobArea::create([
                        'job_id' => $job->job_id,
                        'province_id' => $province_id,
                        'headcount' => $data['headcount'], // Tạm thời lưu chung cho tất cả area
                    ]);
                }
            }

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
            }

            $job = JobHrms::where('job_id', $job->job_id)->first();
            unset($data['province_id']);
            $job->update($data);

            return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
        }
    }

    public function delete($job_id): RedirectResponse
    {
        $job = JobHrms::where('job_id', $job_id)->first();
        if (! $job) {
            return redirect()->route('admin.jobs.index')->with('error', 'Job not found.');
        }
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
