<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('user')->with('user.cvProfile')->with('user.cvProfile.avatar')->with('job')->with('job.organization')->with('job_area')->with('job_area.province')->with('user_document')->getAllApplications()->orderBy('applied_at', 'desc');
        $applications = $applications->paginate(10);
        // dd($applications);
        $users_applied = [];
        $orgs_applied = [];
        foreach ($applications as $application) {
            if ($application->job) {
                $users_applied[$application->user->user_id] = $application->user->first_name.' '.$application->user->last_name;
            }
            // $orgs_applied[$application->job->organization->org_id] = $application->job->organization->name;
        }

        // dd($applications);

        $filter_date = [
            'today',
            'yesterday',
            'this_week',
            'last_week',
            'this_month',
            'last_month',
            'this_year',
            'last_year',
            'custome',
        ];

        return view('admin.application.index', [
            'users_applied' => $users_applied,
            'orgs_applied' => $orgs_applied,
            'applications' => $applications,
        ]);
    }

    public function buildQuery(Request $request)
    {
        $query = Application::with('user')->with('user.cvProfile')->with('user.cvProfile.avatar')->with('job')->with('job.organization')->with('job_area')->with('job_area.province')->with('user_document')->getAllApplications();

        if ($request->has('applied_at')) {
            $query->where('applied_at', $request->applied_at);
        }
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('job_id')) {
            $query->where('job_id', $request->job_id);
        }
        if ($request->has('job_area_id')) {
            $query->where('job_area_id', $request->job_area_id);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    public function show($id)
    {
        $application = Application::with('user')->with('job')->with('job_area')->with('job_area.province')->with('user_document')->find($id);
        // dd($application);

        return view('admin.application.show', ['application' => $application]);
    }

    public function update($id)
    {
        return view('admin.application.update');
    }

    public function destroy($id)
    {
        return view('admin.application.destroy');
    }
}
