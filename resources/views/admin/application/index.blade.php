@extends('layouts.admin')

@section('title', 'Admin Dashboard - Applied')
@section('page_title')
    {{ __("default.txt_apply") }}
@endsection

@section('content')
<style>
  .table-card {
    border-radius: 1rem;
  }
</style>
  <div class="row">
    <div class="col-sm-12">

      <div class="card table-responsive table-card mb-0">
        <table class="table table-hover mb-0" id="pc-dt-simple">
          <thead>
            <tr class="bg-light">
              <th width="7%" class="text-center">ID</th>
              <th width="10%" class="text-center">CV</th>
              <th width="19%">{{ __('application.txt_info_user') }}</th>
              <th width="57%">{{ __('application.txt_info_job') }}</th>
              <th width="7%" class="text-center">{{ __('user.txt_actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($applications as $app)
            <tr class="align-middle">
              <td class="text-center">{{ $app->application_id }}</td>
              <td class="text-center text-truncate" style="max-width: 100px;">
                <a href="{{ $app->user_document->url }}" target="_blank" class="mb-0 fw-bold text-success text-decoration-underline bg-light p-2 rounded border-1 text-truncate">
                  {{ $app->user_document->document_title }} ádfasfsdafsdfaw2f2fwa
                </a>
              </td>
              <td>
                <div class="row">
                  <div class="col lh-lg">
                    <p class="fw-bold mb-0 f-15">{{ $app->user->username }}</p>
                    <p class="text-muted f-12 mb-0"><i class="ti ti-mail"></i> {{ $app->user->email }}</p>
                    <p class="text-muted f-12 mb-0"><i class="ti ti-phone"></i> {{ $app->user->phone_number }}</p>
                  </div>
                </div>
              </td>
              <td> 
                <div class="col lh-lg">
                    <p class="fw-bold mb-0 f-15">{{ $app->job->name }}</p>
                    <p class="text-muted f-12 mb-0"><i class="ti ti-building-skyscraper"></i> {{ $app->job->organization->name }}</p>
                    @if($app->job_area->count() > 0)
                    <div class="text-sm text-gray-600">
                      <i class="ti ti-map-pin"></i>
                        <span class="px-2 py-1 bg-gray-100 rounded-md text-xs">
                            {{ $app->job_area->first()->province->localized_name ?? '' }} {{ $app->job_area->count() > 1 ? ' ' . __('job.txt_and') . ' ' . ($app->job_area->count() - 1) . ' ' . __('job.txt_otherwhere') : '' }}
                        </span>
                    </div>
                    @endif
                </div>
              </td>
              <td class="text-center">
                <ul class="list-inline me-auto mb-0">
                  <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Chi tiết">
                    <a href="{{ route('admin.applications.show', $app->application_id) }}" class="avtar avtar-xs btn-link-success">
                      <i class="ti ti-eye f-18"></i>
                    </a>
                  </li>
                  <!-- <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                    <form action="" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');" style="display: inline;">
                      @csrf
                    <button type="submit" class="avtar avtar-xs btn-link-danger">
                      <i class="ti ti-trash f-18"></i>
                    </button>
                  </li> -->
                </ul>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
          
    </div>
  </div>
  {{ $applications->links('vendor.pagination.bootstrap-5') }}
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