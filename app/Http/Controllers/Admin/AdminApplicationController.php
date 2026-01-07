<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationArea;

class AdminApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('user')->with('job')->with('job_area')->with('user_document');
        $applications = $applications->paginate(10);
        // dd($applications);

        $applications_areas = ApplicationArea::with('application')->with('job_area');
        $applications_areas = $applications_areas->paginate(10);
        // dd($applications_areas);

        return view('admin.application.index', ['applications' => $applications, 'applications_areas' => $applications_areas]);
    }

    public function show($id)
    {
        $application = Application::with('user')->with('job')->with('job_area')->with('user_document')->find($id);
        dd($application);

        return view('admin.application.show');
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
