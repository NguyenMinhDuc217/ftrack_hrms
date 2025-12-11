<?php

namespace App\Http\Controllers;

use App\Models\JobHrms;

class JobController extends Controller
{
    public function detail($id)
    {

        try {
            $job = JobHrms::with('department')->with('area_application', 'area_application.province')->findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Job not found');
        }

        return view('client.job.detail', [
            'job' => $job,
        ]);
    }
}
