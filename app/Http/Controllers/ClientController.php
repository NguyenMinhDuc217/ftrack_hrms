<?php

namespace App\Http\Controllers;

use App\Models\JobHrms;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function buildFilter(Request $request)
    {
        $data = [];
        $data['type'] = 'profession_id';

        if ($request->has('province_id')) {
            $data['province_id'] = $request->province_id;
        }
        if ($request->has('search')) {
            $data['search'] = $request->search;
        }
        if ($request->has('profession_id')) {
            $data['profession_id'] = $data['val'] = $request->profession_id;
            $data['type'] = 'profession_id';
            $data['active'] = 1;
        }

        return $data;
    }

    public function index(Request $request)
    {
        $jobs = $this->buildQuery($request)->where('status', 1)->where('deleted_at', null)->paginate(10);
        // dd($jobs);

        $filters = [
            'profession' => __('job.txt_category'),
            'salary' => __('job.txt_salary'),
        ];
        $provinces = Province::select('id', 'name')->get();

        $data = $this->buildFilter($request);
        $data['jobs'] = $jobs;
        $data['filters'] = $filters;
        $data['provinces'] = $provinces;

        return view('client.index', $data);
    }

    public function buildQuery(Request $request)
    {
        $query = JobHrms::query()->with('profession')->with('job_area')->with('job_area.province');
        if ($request->has('province_id')) {
            $query->whereHas('job_area', function ($q) use ($request) {
                $q->where('province_id', (int) $request->province_id);
            });
        }
        if ($request->has('search')) {
            $key = $request->search;
            $query->where(function ($q) use ($key) {
                $q->where('title', 'like', '%'.$key.'%')
                    ->orWhere('description_md', 'like', '%'.$key.'%')
                    ->orWhere('application_position', 'like', '%'.$key.'%');
            })->orWhereHas('profession', function ($q) use ($key) {
                $q->where('profession_name', 'like', '%'.$key.'%');
            });
        }
        if ($request->has('profession_id')) {
            $query->where('profession_id', $request->profession_id);
        }

        return $query;
    }

    // Authenticated client dashboard
    public function dashboard()
    {
        return view('client.dashboard', ['user' => Auth::user()]);
    }

    // Authenticated client profile page
    public function profile()
    {
        return view('client.profile', ['user' => Auth::user()]);
    }
}
