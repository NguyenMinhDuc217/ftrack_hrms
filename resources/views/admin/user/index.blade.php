@extends('layouts.admin')

@section('title', 'Admin Dashboard - Users')
@section('page_title')
    {{ __("default.txt_users") }}
@endsection

@section('content')
 <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end px-4 py-2">
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success d-inline-flex align-item-center">
                  <i class="ti ti-plus f-18"></i> {{ __('user.txt_add_user') }}
                </a>
              </div>

              <!-- FILTER -->
              <div class="card pb-0">
                <div class="card-header px-4 py-2">
                  <form action="{{ route('admin.users') }}" method="GET" class="" id="filter-area">
                    <div class="card border-0 mb-0">
                      <div class="card-body pb-0">
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <input type="text" name="search" class="form-control form-control-sm" placeholder="{{ __('default.txt_search') }}">
                            </div>
                          </div>
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <input type="date" name="hire_date" class="form-control form-control-sm" value="{{ request('hire_date') }}">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <select name="department_id" class="form-control form-control-sm" onchange="changeDepartment(this.value)">
                                <option value="">-{{ __('user.txt_profession') }}-</option>
                                @foreach ($departments as $department)
                                <option value="{{$department->department_id}}" @selected(request('department_id') == $department->department_id)>
                                  {{ $department->department_name }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <select name="manager_id" class="form-control form-control-sm">
                                <option label="-{{ __('user.txt_manager') }}-"></option>
                                @foreach($managers as $manager)
                                <option value="{{$manager->user_id}}" @selected(request('manager_id') == $manager->user_id)>
                                  {{$manager->username}}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <select name="employment_type" class="form-control form-control-sm @error('employment_type') is-invalid @enderror">
                                <option value="">-{{ __('user.txt_employment_type') }}-</option>
                                @foreach($employment_types as $key => $value)
                                  <option value="{{ $key }}" @selected(request('employment_type') == $key)>
                                      {{ $value['lang'] }}
                                  </option>
                                @endforeach`
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <select name="status" class="form-control form-control-sm">
                                <option value="">-{{ __('user.txt_status') }}-</option>
                                @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" @selected(request('status') == $key)>
                                  {{ $value['lang'] }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <button type="submit" onclick="filter()" class="btn btn-sm btn-success w-100">{{ __('default.button_filter') }}</button>
                            </div>
                          </div>
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
              <!-- FILTER -->

              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>{{ __('user.txt_user_id') }}</th>
                      <th>{{ __('user.txt_username') }}</th>
                      <th>{{ __('user.txt_phone_number') }}</th>
                      <th>{{ __('user.txt_profession') }}</th>
                      <th>{{ __('user.txt_status') }}</th>
                      <th class="text-center">{{ __('user.txt_actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td class="text-center">{{ $user->user_id }}</td>
                      <td>
                        <div class="row">
                          <!-- <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div> -->
                          <div class="col">
                            <h5 class="mb-0">{{ $user->username }}</h5>
                            <p class="text-muted f-12 mb-0">{{ $user->email }}</p>
                          </div>
                        </div>
                      </td>
                      <td>{{ $user->phone_number }}</td>
                      <td>{{ $user->department?->department_name }}</td>
                      <td>
                        @php
                          $status = $user->status->getLabelData();
                        @endphp
                        <span class="badge {{$status['color']}} rounded-pill f-12">{{ $status['lang'] }}</span>
                      </td>
                      <td class="text-center">
                        <ul class="list-inline me-auto mb-0">
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                            <a href="{{ route('admin.users.show', $user->user_id) }}" class="avtar avtar-xs btn-link-primary">
                              <i class="ti ti-edit-circle f-18"></i>
                            </a>
                          </li>
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                            <form action="{{ route('admin.users.delete', $user->user_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');" style="display: inline;">
                              @csrf
                            <button type="submit" class="avtar avtar-xs btn-link-danger">
                              <i class="ti ti-trash f-18"></i>
                            </button>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

        

                  {{ $users->links('vendor.pagination.bootstrap-5') }}

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