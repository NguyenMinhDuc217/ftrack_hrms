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

  <!-- FILTER -->
   <div class="row">
    <div class="col-sm-12">
      <div class="card p-0">
        <div class="card-header px-4 py-2">
          <form action="{{ route('admin.users') }}" method="GET" class="" id="filter-area">
            <div class="card border-0 mb-0">
              <div class="card-body p-0">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input type="text" name="search" class="form-control form-control-sm" placeholder="{{ __('default.txt_search') }}">
                    </div>
                  </div>
                
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input type="date" name="applied_at" class="form-control form-control-sm" value="{{ request('applied_at') }}">
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <select name="user_id" class="form-control form-control-sm">
                        <option label="-User applied-" value=""></option>
                        @if ($users_applied)
                        @foreach ($users_applied as $user_id => $name)
                          <option value="{{ $user_id }}">{{ $name }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
    
                  <div class="col-sm-3">
                    <div class="form-group">
                      <button type="submit" onclick="filter()" class="btn btn-sm btn-success w-100">{{ __('default.button_filter') }}</button>
                    </div>
                  </div>
    
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <select name="employment_type" class="form-control form-control-sm @error('employment_type') is-invalid @enderror">
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <select name="status" class="form-control form-control-sm">
                        <option value="">-{{ __('user.txt_status') }}-</option>
                       
                      </select>
                    </div>
                  </div>
    
                  <div class="col-sm-3"></div>
                  
                  <div class="col-sm-3">
                    <div class="form-group">
                      <a href="{{ route('admin.users') }}" class="btn btn-sm btn-secondary w-100 align-content-center">{{ __('default.button_reset') }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
   </div>
  <!-- FILTER -->

  <div class="row mb-2">
    <div class="col-sm-12 d-flex flex-column gap-2">

      @foreach ($applications as $app)
      @if ($app->job)
      <div class="card table-responsive table-card mb-0 rounded-0">
        <div class="card-header p-3">
          <div class="row d-flex justify-content-between align-items-center m-0">

            <div class="d-flex justify-content-start align-items-center gap-2 col-sm-3 border-end">
              <div class="">
                <img class="img-fluid rounded-circle border shadow-sm" width="50" height="50" alt="Profile" src="{{ ( $app->user->cvProfile->avatar && $app->user->cvProfile) ? $app->user->cvProfile->avatar->url : asset('images/profile/blank-profile.svg') }}"/>
              </div>
              <div class="d-flex align-items-start flex-column gap-2">
                <p class="fw-bold mb-0 f-15">{{ $app->user->username }}</p>
                <p class="text-muted f-12 mb-0"><i class="ti ti-mail"></i> {{ $app->user->email }}</p>
                <p class="text-muted f-12 mb-0"><i class="ti ti-phone"></i> {{ $app->user->phone_number }}</p>
              </div>
            </div>
  
            <div class="d-flex align-items-center gap-2 col-sm-6">
              <div class="d-flex align-items-center justify-content-center rounded bg-color flex-shrink-0" style="width:55px; height:55px">
                <img src="{{ $app->job->organization->image->url ?? asset('images/profile/blank-profile.svg') }}" alt="Company Logo" width="50" height="50" class="object-fit-contain rounded" />
              </div>
              <div class="overflow-hidden">
                <div class="col lh-lg">
                  <p class="fw-bold mb-0 f-15 text-truncate">{{ $app->job->name }}</p>
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
              </div>
            </div>
  
            <div class="col-sm-2 d-flex flex-column justify-content-center text-center text-sm-end align-items-center align-items-sm-end">
              <div class="fs-4 fw-bold ">{{ $app->job_area->count() < 10 ? '0'.$app->job_area->count() : $app->job_area->count() }}</div>
               <div class="bg-color p-2 rounded text-muted" type="button" id="btn-toggle-{{ $app->application_id }}" onclick="toggleCollapse({{ $app->application_id }})" data-bs-toggle="collapse"  aria-expanded="false" aria-controls="collapseExample{{ $app->application_id }}">
                <span class="expand">Total Applicants <i class="ti ti-caret-right"></i></span>
                <span class="compact d-none">Total Applicants <i class="ti ti-caret-down"></i></span>
              </div>
            </div>

          </div>
        </div>
        <div class="card-body pb-0 w-10 collapse" id="collapseExample{{ $app->application_id }}">
          <table class="table table-hover mb-0" id="pc-dt-simple">
            <thead>
              <tr class="bg-light">
                <th width="7%" class="text-center">ID</th>
                <th width="10%" class="text-center">CV</th>
                <th width="19%">Province</th>
                <th width="7%" class="text-center">{{ __('user.txt_actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($app->job_area as $job_area)
              <tr class="align-middle">
                <td class="text-center ">
                  <span class="bg-color p-2 text-blue">{{ $job_area->job_area_id }}</span>
                </td>
                <td class="text-center">
                   <a href="{{ $app->user_document->url }}" target="_blank" class="mb-0 fw-bold text-blue border border-1 border-blue bg-color p-2 rounded border-1 text-truncate">
                    <i class="bi bi-file-earmark-person"></i> View CV
                  </a>
                </td>
                <td>{{ $job_area->province->localized_name }}</td>
                <td class="text-center">
                  <a href="{{ route('admin.applications.show', $app->application_id) }}" class="avtar avtar-xs btn-link-success">
                      <i class="ti ti-eye f-18"></i>
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
      @endforeach
          
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

    function toggleCollapse(id) {
      var btn_toggle = $('#btn-toggle-' + id);
      var iconRight = btn_toggle.find('.expand');
      var iconDown = btn_toggle.find('.compact');

      if ($('#collapseExample' + id).hasClass('show')) {
        iconRight.removeClass('d-none');
        iconDown.addClass('d-none');
      } else {
        iconRight.addClass('d-none');
        iconDown.removeClass('d-none');
      }
      $('#collapseExample' + id).collapse('toggle');
    }
  </script>
@endsection