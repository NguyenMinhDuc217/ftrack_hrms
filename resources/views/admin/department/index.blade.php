@extends('layouts.admin')

@section('title', 'Admin Dashboard - Users')
@section('page_title', 'Users')

@section('content')
 <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end p-4 pb-0">
                <a href="#" class="btn btn-success d-inline-flex align-item-center" data-bs-toggle="modal" data-bs-target="#user-edit_add-modal">
                  <i class="ti ti-plus f-18"></i> Add Department
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Department ID</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($departments as $department)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>{{ $department->department_id }}</td>
                      <td>
                        <div class="row">
                          <!-- <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div> -->
                          <div class="col">
                            <h5 class="mb-0">{{ $department->department_name }}</h5>
                            <p class="text-muted f-12 mb-0">{{ $department->description }}</p>
                          </div>
                        </div>
                      </td>
                      <td>{{ $department->type }}</td>
                      <td>
                        @php
                          $status = $department->status;
                        @endphp
                        <span class="badge {{ $status == 'Active' ? 'bg-light-success' : 'bg-light-danger' }} rounded-pill f-12">{{ $status }}</span>
                      </td>
                      <td class="text-center">
                        <ul class="list-inline me-auto mb-0">
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                            <a href="#" class="avtar avtar-xs btn-link-primary">
                              <i class="ti ti-edit-circle f-18"></i>
                            </a>
                          </li>
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                            <a href="#" class="avtar avtar-xs btn-link-danger">
                              <i class="ti ti-trash f-18"></i>
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>


            {{ $departments->links('vendor.pagination.bootstrap-5') }}

          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
@endsection