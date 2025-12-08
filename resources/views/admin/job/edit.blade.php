@extends('layouts.admin')

@section('title', 'Admin Dashboard - Users')
@section('page_title', __('job.txt_edit_job'))

@section('content')

<!-- [ Main Content ] start -->
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('job.txt_edit_job') }}</h3>
            </div>

            <form action="{{ route('admin.jobs.update', $job) }}" method="POST" class="form-horizontal">
                @csrf
                @if (isset($job))
                @method('PATCH')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label" for="title">{{ __('job.txt_title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="{{ __('job.txt_title') }}" id="title" value="{{ $job->title }}">
                        @error('title')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.maxlength_set_to_characters', ['length' => 100]) }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_department') }}</label>
                        <select class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                            <option label="-{{ __('user.txt_department') }}-"></option>
                            @foreach ($departments as $department)
                            <option value="{{$department->department_id}}" @selected($job->department_id ==
                                $department->department_id)>{{$department->department_name}}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_province') }}</label>
                        <select class="form-control @error('province_code') is-invalid @enderror" name="province_code">
                            <option label="-{{ __('job.txt_province') }}-"></option>
                            @foreach ($provinces as $province)
                            <option value="{{$province->code}}" @selected($job->province_code == $province->code)>
                                {{$province->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('code')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_employment_type') }}</label>
                        <select name="employment_type"
                            class="form-control @error('employment_type') is-invalid @enderror">
                            <option value="">-{{ __('user.txt_employment_type') }}-</option>
                            @foreach($employment_types as $key => $value)
                            <option value="{{ $key }}" @selected($job->employment_type == $key)>
                                {{ $value }}
                            </option>
                            @endforeach`
                        </select>
                        @error('employment_type')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_headcount') }}</label>
                        <input type="number" class="form-control @error('headcount') is-invalid @enderror"
                            name="headcount" placeholder="{{ __('job.txt_headcount') }}" value="{{ $job->headcount }}">
                        @error('headcount')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.enter_a') }} {{ __('default.number') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_description') }}</label>
                        <textarea class="form-control @error('description_md') is-invalid @enderror"
                            name="description_md"
                            placeholder="{{ __('job.txt_description') }}">{{ $job->description_md }}</textarea>
                        @error('description_md')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_requirements') }}</label>
                        <textarea class="form-control @error('requirements_md') is-invalid @enderror"
                            name="requirements_md"
                            placeholder="{{ __('job.txt_requirements') }}">{{ $job->requirements_md }}</textarea>
                        @error('requirements_md')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_min_salary') }}</label>
                        <input type="number" class="form-control @error('min_salary') is-invalid @enderror"
                            name="min_salary" placeholder="{{ __('job.txt_min_salary') }}"
                            value="{{ $job->min_salary }}">
                        @error('min_salary')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.enter_a') }} {{ __('default.number') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_max_salary') }}</label>
                        <input type="number" class="form-control @error('max_salary') is-invalid @enderror"
                            name="max_salary" placeholder="{{ __('job.txt_max_salary') }}"
                            value="{{ $job->max_salary }}">
                        @error('max_salary')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.enter_a') }} {{ __('default.number') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_currency') }}</label>
                        <input type="text" class="form-control @error('currency') is-invalid @enderror" name="currency"
                            placeholder="{{ __('job.txt_currency') }}" value="{{ $job->currency }}">
                        @error('currency')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.enter_a') }} {{ __('default.text') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_status') }}</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="" disabled selected>-{{ __('user.txt_status') }}-</option>
                            <option value="1" @selected($job->status==1)>Hoạt động</option>
                            <option value="0" @selected($job->status==0)>Không hoạt động</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button type="reset" class="btn btn-light">Reset</button>
                </div>
            </form>
        </div>

    </div>
    <!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->
@endsection