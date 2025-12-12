<?php

namespace App\Http\Controllers;

use App\Models\AreaApplication;
use App\Models\JobHrms;
use App\Models\UserDocument;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function detail($id)
    {

        try {
            $job = JobHrms::with('department')->with('area_application', 'area_application.province')->findOrFail($id);

            $user = auth()->user();
            $cvs = UserDocument::where('user_id', $user->user_id)
                ->where('document_type', 'cv_file')
                ->latest()
                ->get();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Job not found');
        }

        return view('client.job.detail', [
            'job' => $job,
            'cvs' => $cvs,
        ]);
    }

    public function applyJob(Request $request)
    {
        dd($request->all());
        if ($request->job_id) {
            $job = JobHrms::findOrFail($request->job_id);
            if ($request->cv_id) {
                $cv = UserDocument::findOrFail($request->cv_id);
                $job = JobHrms::findOrFail($request->job_id);

                // $area = $job->area_application->where('province_code', $request->province_code)->first();
                // $area2 = AreaApplication::where('province_code', $request->province_code)->first();

                
                dd($cv, $job);

            }
        }
    }
}
