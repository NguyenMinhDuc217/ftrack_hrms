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
  @include('admin.partials._scripts')

  <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
  <!-- @vite(['resources/js/app.js']) -->
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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('default.txt_home') }}</a></li>
                @isset($breadcrumbs)
                  @foreach ($breadcrumbs as $breadcrumb)
                    {{-- Check if it's the last item --}}
                    @if ($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                    @endif
                  @endforeach
                @else
                  {{-- Fallback if no specific breadcrumbs are provided --}}
                  {{-- This will show just 'Home' and the page title as the last item --}}
                  @hasSection('page_title')
                    <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
                  @endif
                @endisset
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
  @stack('scripts') {{-- For page-specific JavaScript --}}

  <script>
    $('#filter-area').on('submit', function(e) {
      e.preventDefault();
    })

    function filter() {
      var form = $('#filter-area')[0];
      $(form).find('input, select, textarea, date, checkbox, radio').each(function() {
        if (!this.value || this.value.trim() === '') {
          $(this).removeAttr('name');
        }
      })

      var formData = new FormData(form);
      console.log(formData)

      var url = $(form).attr('action') + '?' + new URLSearchParams(formData).toString();
      window.location.href = url;
    }

    function changeDepartment(department_id) {
      $.ajax({
        url: "{{ route('admin.users.changeDepartment', ['department_id' => '']) }}/" + department_id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          var managerSelect = $('select[name="manager_id"]');
          managerSelect.empty();
          managerSelect.append('<option label="--Manager--"></option>');
          $.each(response, function(index, manager) {
            managerSelect.append('<option value="' + manager.user_id + '">' + manager.username + '</option>');
          });
        }
      })
    }
  </script>

</body>
<!-- [Body] end -->
</html>
