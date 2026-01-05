<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationPostRequest;
use App\Models\Image;
use App\Models\Organization;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $statuses;

    public function __construct()
    {
        $this->statuses = [
            'active' => [
                'lang' => __('default.txt_active'),
                'color' => 'bg-light-success',
            ],
            'inactive' => [
                'lang' => __('default.txt_inactive'),
                'color' => 'bg-light-danger',
            ],
        ];
    }

    public function index()
    {
        $orgs = Organization::whereNull('deleted_at')->paginate(10);

        return view('admin.organization.index', ['orgs' => $orgs, 'statuses' => $this->statuses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['label' => __('org.txt_add_org'), 'url' => route('admin.orgs.index')],
        ];

        return view('admin.organization.add',
            [
                'breadcrumbs' => $breadcrumbs,
                'statuses' => $this->statuses,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationPostRequest $request, ImageService $imageService)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            unset($data['image']);
            $org = Organization::create($data);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_image = new Image([
                    'name' => $image->getClientOriginalName(),
                    'type' => 'org',
                    'file_name_original' => $image->getClientOriginalName(),
                    'size' => $image->getSize(),
                    'mime_type' => $image->getMimeType(),
                    'status' => 1,
                ]);
                $file = $imageService->upload($image, $new_image, 'orgs');
                $org->update(['image_id' => $file->id]);
            }
            DB::commit();

            return redirect()->route('admin.orgs.index')->with('success', __('org.txt_success_add'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', __('org.txt_failed_add'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($org_id)
    {
        $org = Organization::where('org_id', $org_id)->first();

        $breadcrumbs = [
            ['label' => __('org.txt_edit_org'), 'url' => route('admin.jobs.index')],
            ['label' => 'Edit org: '."{$org->org_id} - {$org->name}", 'url' => route('admin.jobs.show', $org_id)],
        ];

        return view('admin.organization.edit',
            [
                'breadcrumbs' => $breadcrumbs,
                'org' => $org,
                'statuses' => $this->statuses,
            ]);
    }

    public function uploadEditorImage(Request $request, ImageService $imageService)
    {
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $fileName = time().'_'.$image->getClientOriginalName();

            $new_image = new Image([
                'name' => $fileName,
                'type' => 'des',
                'file_name_original' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
                'mime_type' => $image->getMimeType(),
                'status' => 1,

            ]);
            $file = $imageService->upload($image, $new_image, 'orgs');

            $url = $file->url;

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }

        return response()->json(['uploaded' => false, 'error' => ['message' => __('org.txt_failed_image')]], 400);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationPostRequest $request, ?Organization $org, ImageService $imageService)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_image = new Image([
                    'name' => $image->getClientOriginalName(),
                    'type' => 'org',
                    'file_name_original' => $image->getClientOriginalName(),
                    'size' => $image->getSize(),
                    'mime_type' => $image->getMimeType(),
                    'status' => 1,

                ]);
                $file = $imageService->upload($image, $new_image, 'orgs');
                $data['image_id'] = $file->id;
            }

            $org->update($data);
            DB::commit();

            return redirect()->route('admin.orgs.index')->with('success', __('org.txt_success_update'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', __('org.txt_failed_update'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Organization $org, ImageService $imageService)
    {
        DB::beginTransaction();
        try {
            if ($org->image_id) {
                $imageService->deletebyId($org->image_id);
            }
            $org->delete();
            DB::commit();

            return redirect()->route('admin.orgs.index')->with('success', __('org.txt_success_delete'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', __('org.txt_failed_delete'));
        }
    }
}
