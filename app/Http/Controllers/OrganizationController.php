<?php

namespace App\Http\Controllers;

use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index() {}

    public function detail(Organization $org)
    {
        $org->load([
            'jobs' => function ($query) {
                $query->active();
            },
            'jobs.job_area.province'
        ]);
        $activeJobs = $org->jobs->count();

        return view('client.org.detail', compact('org', 'activeJobs'));
    }
}
