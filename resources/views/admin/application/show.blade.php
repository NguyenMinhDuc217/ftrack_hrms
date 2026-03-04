@extends('layouts.admin')

@section('title', 'Admin Dashboard - Applied')
@section('page_title')
    {{ __("default.txt_apply") }}
@endsection

@section('content')
<style>
    .info-user {
        padding-right: 13.5px !important;
    }
    .info-job {
        padding-left: 13.5px !important;
    }
    @media (max-width: 576px) {
        .info-user {
            padding-right: 0.35rem !important;
        }
        .info-job {
            padding-left: 0.35rem !important;
        }
    }
</style>
<div class="row pt-0">
    <div class="col-sm-4 info-user">
        <div class="card">
            <div class="card-header bg-color p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold">{{ Str::upper('Info User') }}</span>
                    <span class="badge bg-success d-flex align-items-center p-2 rounded">{{ $application->job->employment_type }}</span>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{ __('user.txt_firstname') }}: 
                    <span class="fw-bold">
                        {{ $application->user->last_name ?? '' . ' ' . $application->user->first_name ?? '' }}
                    </span>
                </p>
                <p class="card-text">Email: 
                    <span class="fw-bold">
                        {{ $application->user->email }}
                    </span>
                </p>
                <p class="card-text">{{ __('user.txt_phone_number') }}:  
                    <span class="fw-bold">
                        {{ $application->user->phone_number }}
                    </span>
                </p>
                <p class="card-text border-b-4 border-indigo-500">
                    <span>CV: 
                        <a href="{{ $application->user_document->url }}" target="_blank">
                            {{ $application->user_document->document_title }}
                        </a>
                    </span>
                    
                </p>
                <p class="card-text">
                    {{ __('job.txt_current_salary') }}:
                    <span class="fw-bold">
                     {{ number_format($application->current_salary/ 1000000, 1) }}M VND
                    </span>
                </p>
                <p class="card-text">
                    {{ __('job.txt_expected_salary') }}:
                    <span class="fw-bold">
                     {{ number_format($application->expected_salary/ 1000000, 1) }}M VND
                    </span>
                </p>
                <p class="card-text">
                    {{ __('job.txt_expected_start_date') }}:
                    <span class="fw-bold">
                     {{ \Carbon\Carbon::parse($application->expected_start_date)->format('d/m/Y') }}
                    </span>
                </p>
                <p class="card-text">
                    {{ __('job.txt_work_experience') }}:
                    <span class="fw-bold">
                     {{ $application->work_experience ? trim(str_replace(['năm', 'year', 'years', 'Năm', 'Year', 'Years'], '', $application->work_experience)) . ' '. __('job.txt_year')  : __('job.txt_no_experience') }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-8 info-job">
        <div class="card">
            <div class="card-body p-0">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fs-4 fw-bold">{{ Str::upper($application->job->name) }}</span>
                        <span class="badge bg-color text-black d-flex align-items-center p-2 rounded border">ID: {{ $application->job->job_id }}</span>
                    </div>
                    @if($application->job->organization)
                    <div class="text-gray-500 mt-2">
                        <i class="ti ti-building-community mr-2"></i>
                        {{ $application->job->organization->name }}
                    </div>
                    @endif
                </div>

                <div class="row mx-0">
                    <div class="col-sm-4 border p-4 d-flex flex-column align-items-center justify-content-center gap-1">
                        <span>{{ strtoupper(__('job.txt_income')) }}</span>
                        <span class="fw-bold">
                            <i class="ti ti-coin text-blue text-3xl"></i> {{ __('job.txt_salary_rank', ['min' => number_format($application->job->min_salary / 1000000, 1), 'max' => number_format($application->job->max_salary / 1000000, 1)]) }}
                        </span>
                        <span class="text-secondary">Monthly</span>
                    </div>
                    <div class="col-sm-4 border p-4 d-flex flex-column align-items-center justify-content-center gap-1">
                        <span>{{ strtoupper(__('job.txt_experience')) }}</span>
                        <span class="fw-bold">
                            <i class="bi bi-hourglass text-accent text-3xl"></i> {{ $application->job->experience ? trim(str_replace(['năm', 'year', 'years', 'Năm', 'Year', 'Years'], '', $application->job->experience)) . ' '. __('job.txt_year')  : __('job.txt_no_experience') }}
                        </span>
                        <span class="text-secondary">Required</span>
                    </div>
                    <div class="col-sm-4 border p-4 d-flex flex-column align-items-center justify-content-center gap-1">
                        <span>{{ strtoupper(__('job.txt_location')) }}</span>
                        <span class="fw-bold">
                            @foreach($application->job_area as $job_area)
                                <span>{{ $job_area->province->localized_name }}</span>
                            @endforeach
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <p class="card-text ">Job Description: 
                        <div class="bg-color p-2 rounded">
                            {!! $application->job->description_md !!}
                        </div>
                    </p>
                    <p class="card-text ">Job Requirement: 
                        <div class="bg-color p-2 rounded">
                            {!! $application->job->requirements_md !!}
                        </div>
                    </p>
                    <p class="card-text ">Job Type: {{ $application->job->type }}</p>
                    <p class="card-text">
                        Job Salary: {{ $application->job->min_salary . ' ' . $application->job->currency }} - {{ $application->job->max_salary . ' ' . $application->job->currency }}
                    </p>
                    <p class="card-text">Job experience: {{ $application->job->experience }}</p>
    
                    <div>
                        @foreach($application->job_area as $job_area)
                            <span>{{ $job_area->province->localized_name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection