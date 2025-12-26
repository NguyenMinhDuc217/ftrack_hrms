@extends('layouts.admin')

@section('title')
{{  'Admin Dashboard -' . __("default.txt_job") }}
@endsection
@section('page_title')
{{ __("default.txt_job") }}
@endsection

@section('content')
<!-- [ Main Content ] start -->
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-body">
                <div class="text-end px-4 py-2">
                    <a href="{{ route('admin.jobs.create') }}"
                        class="btn btn-sm btn-success d-inline-flex align-items-center">
                        <i class="ti ti-plus f-18"></i> {{ __('job.txt_add_job') }}
                    </a>
                </div>

                <!-- FILTER -->

                <!-- FILTER -->

                <div class="table-responsive">
                    <table class="table table-hover" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th width="30%">{{ __('job.txt_title') }}</th>
                                <th width="15%">{{ __('job.txt_salary') }}</th>
                                <th width="10%">{{ __('job.txt_experience') }}</th>
                                <th width="15%">{{ __('job.txt_apply_deadline') }}</th>
                                <th width="10%">{{ __('user.txt_status') }}</th>
                                <th width="15%" class="text-center">{{ __('user.txt_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr class="align-middle">
                                <td class="text-left">{{ $job->job_id }}</td>
                                <td>
                                        <!-- <div class="col-auto pe-0">
                                            <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                                            class="wid-40 rounded-circle">
                                        </div> -->
                                        <div class="col">
                                            <span class="mb-0">{{ $job->name }}</span>
                                        </div>
                                </td>
                                <td>
                                        <div class="col">
                                            <span class="mb-0">
                                                {{ __('job.txt_salary_rank', ['min' => number_format($job->min_salary / 1000000, 1), 'max' => number_format($job->max_salary / 1000000, 1)]) }}
                                            </span>
                                        </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <span class="mb-0">
                                            {{ $job->experience ? trim(str_replace(['năm', 'year', 'years', 'Năm', 'Year', 'Years'], '', $job->experience)) . ' '. __('job.txt_year')  : __('job.txt_no_experience') }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <span class="mb-0">{{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td>
                                        <div class="col">
                                            <h5 class="badge {{$statuses[$job->status]['color']}} rounded-pill f-12">{{ $statuses[$job->status]['lang'] }}</h5>
                                            </div>
                                </td>
                                <td class="text-center">
                                    <ul class="list-inline me-auto mb-0">
                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                                            <a href="{{ route('admin.jobs.show', $job->job_id) }}"
                                                class="avtar avtar-xs btn-link-primary">
                                                <i class="ti ti-edit-circle f-18"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                            title="Delete" delete_id="{{ $job->job_id }}">
                                            <form action="{{ route('admin.jobs.delete', $job->job_id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa công việc này không?');"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="avtar avtar-xs btn-link-danger">
                                                    <i class="ti ti-trash f-18"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $jobs->links('vendor.pagination.bootstrap-5') }}

        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->
<script>
@if(session('success'))
Toast.fire({
    icon: "success",
    title: "{{ session('success') }}"
});
@endif
@if(session('error'))
Toast.fire({
    icon: 'error',
    title: "{{ session('error') }}"
});
@endif
</script>
@endsection