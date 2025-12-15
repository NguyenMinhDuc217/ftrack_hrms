<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobHrms;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function detail($id)
    {
        try {
            $job = JobHrms::with('profession')->with('job_area', 'job_area.province')->findOrFail($id);
            // dd($job);
            if (Auth::check()) {
                $user = auth()->user();
                $cvs = UserDocument::where('user_id', $user->user_id)
                    ->where('document_type', 'cv_file')
                    ->latest()
                    ->get();
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Job not found');
        }

        return view('client.job.detail', [
            'job' => $job ?? null,
            'cvs' => $cvs ?? null,
        ]);
    }

    public function applyJob(Request $request)
    {
        if ($request->job_id) {
            $job = JobHrms::findOrFail($request->job_id);
            if ($request->cv_id) {
                $cv = UserDocument::findOrFail($request->cv_id);
                $job = JobHrms::findOrFail($request->job_id);
                $user_document = UserDocument::findOrFail($request->cv_id);

                $area = $job->area_application->where('province_code', $request->province_code)->first();

                dd($job->job_id, $request->province_code, Auth::user()->user_id);
                dd(getFullSql(Application::where('job_id', $job->job_id, 'province_code', $request->province_code, 'user_id', Auth::user()->user_id)->first()));
                $application = Application::where('job_id', $job->job_id, 'province_code', $request->province_code, 'user_id', Auth::user()->user_id)->first();
                if ($application) {
                    $application->update([
                        'user_document_id' => $cv->id,
                        'province_code' => $request->province_code,
                        'date_apply' => now(),
                    ]);

                    return redirect()->back()->with('success', 'Apply successfully');
                } else {
                    Application::create([
                        'job_id' => $job->job_id,
                        'user_id' => Auth::user()->user_id,
                        'user_document_id' => $cv->id,
                        'province_code' => $request->province_code,
                        'date_apply' => now(),
                    ]);

                    return redirect()->back()->with('success', 'Apply successfully');
                }
            } elseif ($request->user_document_id) {
                $user_document = UserDocument::findOrFail($request->user_document_id);
                $job = JobHrms::findOrFail($request->job_id);
                $area = $job->area_application->where('province_code', $request->province_code)->first();

                $application = Application::where('job_id', $job->job_id, 'province_code', $request->province_code, 'user_id', Auth::user()->user_id)->first();
                if ($application) {
                    $application->update([
                        'user_document_id' => $user_document->id,
                        'province_code' => $request->province_code,
                        'date_apply' => now(),
                    ]);

                    return redirect()->back()->with('success', 'Apply successfully');
                } else {
                    Application::create([
                        'job_id' => $job->job_id,
                        'province_code' => $request->province_code,
                        'user_document_id' => $user_document->id,
                        'user_id' => Auth::user()->user_id,
                        'date_apply' => now(),
                    ]);

                    return redirect()->back()->with('success', 'Apply successfully');
                }
            }
        }
    }
}
