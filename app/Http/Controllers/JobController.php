<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobHrms;
use App\Models\Province;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function detail($id)
    {
        try {
            $job = JobHrms::with('profession')->with('job_area', 'job_area.province')->findOrFail($id);
            if (Auth::check()) {
                $user = auth()->user();
                $cvs = UserDocument::where('user_id', $user->user_id)
                    ->where('document_type', 'cv_file')
                    ->latest()
                    ->get();
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('job.job_not_exists'));
        }

        return view('client.job.detail', [
            'job' => $job ?? null,
            'cvs' => $cvs ?? null,
        ]);
    }

    public function applyJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required:exists:job_hrms,job_id',
            'cv_id' => 'required:exists:user_documents,id',
            'province_id' => 'required:exists:provinces,id',
        ]);

        $user = Auth::user();
        $job_id = $request->job_id;
        $cv_id = $request->cv_id;
        $province_id = $request->province_id;

        $province = Province::findOrFail($province_id);
        if (! $province) {
            return back()->with('error', __('job.province_not_exists'));
        }

        // Kiểm tra job có tồn tại ở khu vực này không
        $job = JobHrms::with(['job_area' => fn ($q) => $q->where('province_id', $province_id)])->findOrFail($job_id);
        $jobArea = $job->job_area->first();
        if (! $jobArea) {
            return back()->with('error', __('job.application_area_not_exists'));
        }

        // Kiểm tra CV
        $cv = UserDocument::where('id', $cv_id)->where('user_id', $user->user_id)->where('document_type', 'cv_file')->where('deleted_at', null)->first();
        if (! $cv) {
            return back()->with('error', __('job.cv_not_exists'));
        }

        DB::beginTransaction();
        try {
            // Tìm | tạo mới, KHÔNG update nếu đã có
            $application = Application::firstOrCreate([
                'job_id' => $job->job_id,
                'user_id' => Auth::user()->user_id,
                'user_document_id' => $cv->id,
            ], [
                'applied_at' => now(), // Chỉ set khi tạo mới
            ]);
            // Nếu application không được tạo mới thì update thời gian nộp
            if ($application->wasRecentlyCreated === false) {
                $application->update(['applied_at' => now()]);
            }

            $application->job_area()->syncWithoutDetaching($jobArea->job_area_id); // Đồng bộ (không đồng bộ timestamp)
            $application->job_area()->updateExistingPivot($jobArea->job_area_id, []); // Cập nhật timestamp

            DB::commit();

            return redirect()->back()->with('success', __('job.apply_success'))->with('applied_successfully', true);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Apply job failed: '.$e->getMessage(), $request->all());

            return redirect()->back()->with('error', __('job.apply_failed'));
        }
    }
}
