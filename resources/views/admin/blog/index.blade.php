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
                <a href="{{ route('admin.blog.create') }}" class="btn btn-sm btn-success d-inline-flex align-item-center">
                  <i class="ti ti-plus f-18"></i> {{ __('user.txt_add_user') }}
                </a>
              </div>

              <!-- FILTER -->
              
              <!-- FILTER -->

              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Title / Content</th>
                      <th>Category</th>
                      <th>{{ __('user.txt_status') }}</th>
                      <th class="text-center">{{ __('user.txt_actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                      <td class="text-center">{{ $blog->blog_id }}</td>
                      <td>
                        <div class="row">
                          <!-- <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div> -->
                          <div class="col">
                            <h5 class="mb-0">{{ $blog->title }}</h5>
                            <p class="text-muted f-12 mb-0">{{ $blog->content }}</p>
                          </div>
                        </div>
                      </td>
                      <td>{{ $blog->category_id }}</td>
                      <td>
                        <span class="badge bg-success rounded-pill f-12">{{ $blog?->status }}</span>
                      </td>
                      <td class="text-center">
                        <ul class="list-inline me-auto mb-0">
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                            <a href="" class="avtar avtar-xs btn-link-primary">
                              <i class="ti ti-edit-circle f-18"></i>
                            </a>
                          </li>
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                            <form action="" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người bài viết này không?');" style="display: inline;">
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

                  {{ $blogs->links('vendor.pagination.bootstrap-5') }}

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