<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
  <title>@yield('title', 'Admin Dashboard | Mantis Template')</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="@yield('description', 'Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.')">
  <meta name="keywords" content="@yield('keywords', 'Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template')">
  <meta name="author" content="CodedThemes">

  @include('admin.partials._head')
  @stack('styles') {{-- For page-specific CSS --}}
  <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  @include('admin.partials._preloader')
 <x-admin.sidebar />
  @include('admin.partials._header')

  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <!-- <div class="page-header-title">
                <h5 class="m-b-10">@yield('page_title', 'Home')</h5>
              </div> -->
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                @hasSection('breadcrumb_items')
                    @yield('breadcrumb_items')
                @else
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li> -->
                    <li class="breadcrumb-item" aria-current="page">@yield('page_title', 'Home')</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      @yield('content')
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->

  @include('admin.partials._footer')
  @include('admin.partials._scripts')
  @stack('scripts') {{-- For page-specific JavaScript --}}

</body>
<!-- [Body] end -->
</html>
