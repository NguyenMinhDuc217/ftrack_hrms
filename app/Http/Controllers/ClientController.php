<?php

namespace App\Http\Controllers;

use App\Models\JobHrms;
use App\Models\Profession;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function buildFilter(Request $request)
    {
        $data = [];
        $data['type'] = 'profession_slug';

        if ($request->has('province_code_name')) {
            $data['province_code_name'] = $request->province_code_name;
        }
        if ($request->has('search')) {
            $data['search'] = $request->search;
        }
        if ($request->has('profession_slug')) {
            $slugs = explode(',', $request->profession_slug);
            $slugs = array_unique($slugs);
            if (! empty($slugs) && is_array($slugs)) {
                foreach ($slugs as $slug) {
                    $profession = Profession::where('slug', $slug)->first();
                    $data['list_filter_profession'][] = $profession;
                }
            } else {
                $data['profession_slug'] = $data['val'] = $request->profession_slug;
            }
            $data['type'] = 'profession_slug';
            $data['active'] = 1;
        }

        return $data;
    }

    public function index(Request $request)
    {
        $jobs = $this->buildQuery($request)->paginate(9);

        $professions_tips = Profession::active()->whereIn('profession_id', [1, 2, 10])->get(); // Sales, Merchandising, Marketing
        foreach ($professions_tips as $profession_tip) {
            switch ($profession_tip->profession_id) {
                case 1:
                    $profession_tip->localized_name = __('job.txt_sales_staff');
                    break;
                case 2:
                    $profession_tip->localized_name = __('job.txt_display_staff');
                    break;
                case 10:
                    $profession_tip->localized_name = __('job.txt_marketing_staff');
                    break;
            }
        }

        $filters = [
            'profession' => __('job.txt_category'),
            // 'salary' => __('job.txt_salary'),
        ];
        $provinces = Province::select('id', 'name', 'code_name')->get();

        $data = $this->buildFilter($request);
        $data['jobs'] = $jobs ?? [];
        $data['filters'] = $filters ?? [];
        $data['provinces'] = $provinces ?? [];
        $data['professions_tips'] = $professions_tips ?? [];

        return view('client.index', $data);
    }

    public function buildQuery(Request $request)
    {
        $query = JobHrms::query()->with('job_area')->with('job_area.province')->with('organization')->active();
        if ($request->has('province_code_name')) {
            $query->whereHas('job_area.province', function ($q) use ($request) {
                $q->where('code_name', $request->province_code_name);
            });
        }
        if ($request->has('search')) {
            $key = $request->search;
            $query->where(function ($q) use ($key) {
                $q->where('name', 'like', '%'.$key.'%')
                    ->orWhere('description_md', 'like', '%'.$key.'%')
                    ->orWhere('application_position', 'like', '%'.$key.'%')
                    ->orWhereHas('organization', function ($q) use ($key) {
                        $q->where('name', 'like', '%'.$key.'%');
                    });
            });
        }

        if ($request->has('profession_slug')) {
            $slugs = explode(',', $request->profession_slug);
            $slugs = array_unique($slugs);
            $query->whereRaw('JSON_VALID(profession_ids)');

            $query->where(function ($q) use ($slugs) {
                foreach ($slugs as $slug) {
                    $profession_ids = Profession::select('profession_id')->where('slug', $slug)->pluck('profession_id')->toArray();
                    if (! empty($profession_ids)) {
                        $q->orWhere(function ($subQ) use ($profession_ids) {
                            foreach ($profession_ids as $id) {
                                $subQ->orWhereJsonContains('profession_ids', (string) $id)
                                    ->orWhereJsonContains('profession_ids', (int) $id);
                            }
                        });
                    }
                }
            });
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
                        'code_name' => $province->code_name,
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
