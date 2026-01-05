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
                <a href="{{ route('admin.orgs.create') }}" class="btn btn-success d-inline-flex align-item-center">
                  <i class="ti ti-plus f-18"></i> {{ __('org.txt_add_org') }}
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Phone number</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orgs as $org)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>{{ $org->org_id }}</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            @php $img = $org->image @endphp
                            <img src="{{ $img ? $img->url : asset('images/profile/blank-profile.svg') }}" class="img-thumbnail object-fit-contain" id="logo-preview" style="height: 60px !important; width: 60px;">
                          </div>
                          <div class="col d-flex flex-column justify-content-center">
                            <h5 class="mb-0">{{ $org->name }}</h5>
                            <p class="text-muted f-12 mb-0">{{ $org->address }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <p class="text-muted f-12 mb-0">{{ $org->phone_number }}</p>
                            <p class="text-muted f-12 mb-0">{{ $org->email }}</p>
                        </div>
                      </td>
                      <td>
                          <div class="col">
                              <h5 class="badge {{$statuses[$org->status]['color']}} rounded-pill f-12">{{ $statuses[$org->status]['lang'] }}</h5>
                          </div>
                      </td>
                      <td class="text-center">
                        <ul class="list-inline me-auto mb-0">
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                            <a href="{{ route('admin.orgs.show', $org->org_id) }}" class="avtar avtar-xs btn-link-primary">
                              <i class="ti ti-edit-circle f-18"></i>
                            </a>
                          </li>
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                            <form action="{{ route('admin.orgs.delete', $org->org_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');" style="display: inline;">
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

                  {{ $orgs->links('vendor.pagination.bootstrap-5') }}

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