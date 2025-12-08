<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\Department;
use App\Models\Job;
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

        $jobs = Job::whereNull('deleted_at')->paginate(10);

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

        return view(
            'admin.job.add',
            [
                'departments' => $departments,
                'provinces' => $provinces,
                'employment_types' => $employment_types,
                'data' => $data,
            ]
        );
    }

    public function show($job_id)
    {
        $job = Job::where('job_id', $job_id)->first();

        $breadcrumbs = [
            ['label' => __('job.txt_edit_job'), 'url' => route('admin.jobs.index')],
            ['label' => 'Edit Job: '."{$job->job_id} - {$job->title}", 'url' => route('admin.jobs.show', $job_id)],
        ];

        $departments = Department::where('status', 'active')->get();
        $provinces = Province::all();
        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();

        return view(
            'admin.job.edit',
            [
                'breadcrumbs' => $breadcrumbs,
                'job' => $job,
                'departments' => $departments,
                'provinces' => $provinces,
                'employment_types' => $employment_types,
            ]
        );
    }

    public function update(JobPostRequest $request, ?Job $job = null): RedirectResponse
    {
        $data = $request->validated();

        if ($job) {
            $job = Job::where('job_id', $job->job_id)->first();
            $job->update($data);

            return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
        } else {
            $job = Job::create($data);

            return redirect()->route('admin.jobs.index')->with('success', 'Job added successfully.');
        }
    }

    public function delete($job_id): RedirectResponse
    {
        $job = Job::where('job_id', $job_id)->first();
        if (! $job) {
            return redirect()->route('admin.jobs.index')->with('error', 'Job not found.');
        }
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
