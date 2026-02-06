<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>CPM VIETNAM</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('client/assets/img/cpm-favicon.webp') }}" rel="icon">
    <link href="{{ asset('client/assets/img/cpm-favicon-apple.webp') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <script src="{{ asset('client/assets/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Vendor CSS Files -->
    <link href="{{ asset('client/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/datepicker/datepicker-bs5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/swal2/sweetalert2.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/swal2/sweetalert2.bootstrap-5.css') }}" rel="stylesheet">

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/tabler-icons.min.css') }}">

    <!-- Main CSS File -->
    <link href="{{ asset('client/assets/css/main.css') }}" rel="stylesheet">

    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('fancyapps/ui/dist/fancybox/fancybox.css') }}">
    <script src="{{ asset('fancyapps/ui/dist/fancybox/fancybox.umd.js') }}"></script>

    <!--Select2 -->
    <link href="{{ asset('client/assets/vendor/select2/dist/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/vendor/select2/dist/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Mulish' !important;
        }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1F7DBC', // lime-600
                        'primary-hover': '#1F7DBC', // lime-700
                        secondary: '#1e40af', // blue-800
                        footer: '#2f4f18', // custom dark green
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            max-height: 100vh;
            overflow-y: scroll;
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        :root::-webkit-scrollbar {
            display: none;
        }
        body {
            font-family: 'Inter', sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .page {
            max-width: 1340px !important
        }

        body, section {
            background-color: #f9fafb !important;
        }

        .container {
            max-width: 1340px !important;
        }
        
    </style>

    @stack('styles') {{-- For page-specific CSS --}}

    @stack('seo_tags')
</head>

<body class="index-page">

    @include('client.partials.header')

    <main class="main page mx-auto !w-100" >
        @yield('content')
    </main>

    @auth
    @if(session('show_create_cv_modal'))
    <x-client.create-cv />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal($('#CreateCVModal'), {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();

            //Xóa flag sau khi hiện (chỉ hiện 1 lần)
            fetch(`{{ route('clear.create.cv.flag') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        });
    </script>
    @endif
    @endauth

    @if(!Route::is('login'))
    @include('client.partials.footer')
    @endif

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center bg-black"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('client/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/datepicker/datepicker-full.min.js') }}"></script>
    <script src="{{ asset('client/assets/vendor/swal2/sweetalert2.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('client/assets/js/main.js') }}"></script>

    <script src="{{ asset('client/assets/vendor/select2/dist/js/select2.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2-single').select2({
                placeholder: "{{ __('default.txt_location') }}",
                allowClear: true,
                width: '100%',
                theme: "bootstrap-5" // Tùy chỉnh theme cho Bootstrap 5
            });
        });
    </script>


    @include('client.partials._scripts')
    @stack('scripts') {{-- For page-specific JavaScript --}}
</body>

</html>