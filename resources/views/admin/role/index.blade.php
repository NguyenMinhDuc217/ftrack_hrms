@extends('layouts.admin')

@section('title', 'Admin Dashboard - Roles')
@section('page_title', 'Roles')

@section('content')
 <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end p-4 pb-0">
                <a href="#" class="btn btn-success d-inline-flex align-item-center" data-bs-toggle="modal" data-bs-target="#user-edit_add-modal">
                  <i class="ti ti-plus f-18"></i> Add Role
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Role ID</th>
                      <th>Role Name</th>
                      <th>Created Time</th>
                      <th>Updated Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $role)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>{{ $role->id }}</td>
                      <td>{{ $role->name }}</td>
                      <td>{{ $role->created_at }}</td>
                      <td>{{ $role->updated_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
@endsection
