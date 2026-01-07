<?php

namespace App\Http\Controllers;

use App\Models\JobHrms;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $jobs = $this->buildQuery($request)->paginate(10);

        $filters = [
            'profession' => __('job.txt_category'),
            // 'salary' => __('job.txt_salary'),
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
        $query = JobHrms::query()->with('profession')->with('job_area')->with('job_area.province')->with('organization')->active();
        if ($request->has('province_id')) {
            $query->whereHas('job_area', function ($q) use ($request) {
                $q->where('province_id', (int) $request->province_id);
            });
        }
        if ($request->has('search')) {
            $key = $request->search;
            $query->where(function ($q) use ($key) {
                $q->where('name', 'like', '%'.$key.'%')
                    ->orWhere('description_md', 'like', '%'.$key.'%')
                    ->orWhere('application_position', 'like', '%'.$key.'%')
                    ->orWhereHas('profession', function ($q) use ($key) {
                        $q->where('profession_name', 'like', '%'.$key.'%');
                    })
                    ->orWhereHas('organization', function ($q) use ($key) {
                        $q->where('name', 'like', '%'.$key.'%');
                    });
            });
        }
        if ($request->has('profession_id')) {
            $query->where('profession_id', $request->profession_id);
        }

        return $query;
    }

    public function getCurrentLocation(Request $request)
    {
        if ($request->latitude == '' || $request->longitude == '') {
            return response()->json([
                'status' => 'error',
                'title' => __('default.delete_error_text'),
                'message' => __('default.error_location_not_found'),
            ]);
        }

        $response = Http::get('https://api.bigdatacloud.net/data/reverse-geocode-client', [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'localityLanguage' => app()->getLocale(),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $localityInfo = $data['localityInfo'];
            if (isset($localityInfo['administrative'][2]['adminLevel']) && $localityInfo['administrative'][2]['adminLevel'] == 4) {
                $province_name = $localityInfo['administrative'][2]['name'];

                if (app()->getLocale() == 'vi' && $province_name != '') {
                    $province = Province::where('full_name', 'like', '%'.$province_name.'%')->first();
                } elseif (app()->getLocale() == 'en' && $province_name != '') {
                    $province = Province::where('full_name_en', 'like', '%'.$province_name.'%')->first();
                }
                if ($province) {
                    return response()->json([
                        'status' => 'success',
                        'province_id' => $province->id,
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'title' => __('default.delete_error_text'),
                'message' => __('default.error_location_not_found'),
            ]);
        }
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
