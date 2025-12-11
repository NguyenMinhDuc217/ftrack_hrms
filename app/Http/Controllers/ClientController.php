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
        $data['type'] = 'department_id';

        if ($request->has('province_id')) {
            $data['province_id'] = $request->province_id;
        }
        if ($request->has('search')) {
            $data['search'] = $request->search;
        }
        if ($request->has('department_id')) {
            $data['department_id'] = $data['val'] = $request->department_id;
            $data['type'] = 'department_id';
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
        $provinces = Province::select('code', 'name')->get();

        $data = $this->buildFilter($request);
        $data['jobs'] = $jobs;
        $data['filters'] = $filters;
        $data['provinces'] = $provinces;

        return view('client.index', $data);
    }

    public function buildQuery(Request $request)
    {
        $query = JobHrms::query()->with('department')->with('area_application')->with('area_application.province');
        if ($request->has('province_id')) {
            $query->whereHas('area_application', function ($q) use ($request) {
                $q->where('province_code', (int) $request->province_id);
            });
        }
        if ($request->has('search')) {
            $key = $request->search;
            $query->where(function ($q) use ($key) {
                $q->where('title', 'like', '%'.$key.'%')
                    ->orWhere('description_md', 'like', '%'.$key.'%')
                    ->orWhere('application_position', 'like', '%'.$key.'%');
            })->orWhereHas('department', function ($q) use ($key) {
                $q->where('department_name', 'like', '%'.$key.'%');
            });
        }
        if ($request->has('department_id')) {
            $query->where('department_id', $request->department_id);
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
