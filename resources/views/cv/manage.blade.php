@extends('layouts.client')

@section('title', __('cv.manage_cvs'))

@push('styles')
    <style>
        :root {
            --bg-main: #f0f4f8;
            --text-dark: #111827;
            --text-muted: #6b7280;

            /* --accent-color */
            --accent-color-hover: #5B9426;
        }

        /* Custom Color Overrides */
        .text-primary-custom { color: var(--accent-color) !important; }
        .bg-primary-custom { background-color: var(--accent-color) !important; }
        .btn-primary-custom {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
            font-weight: 700;
        }
        .btn-primary-custom:hover {
            background-color: var(--accent-color-hover);
            border-color: var(--accent-color-hover);
            color: white;
        }

        /* Navigation */
        .nav-avatar-ring {
            width: 32px;
            height: 32px;
            border: 2px solid var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* Upload Area */
        .upload-area {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e0;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            position: relative;
        }
        .upload-area:hover, .upload-area:focus-within {
            background-color: #fff;
            border-color: var(--accent-color);
        }
        .upload-area:hover i, .upload-area:focus-within i {
            color: var(--accent-color) !important;
        }
        
        /* Make the file input cover the area but invisible */
        .upload-area input[type=file] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* File Input Group Styling */
        .file-input-group .form-control {
            border-right: 0;
        }
        .file-input-group .btn-file {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-left: 0;
            color: #212529;
            font-weight: 500;
        }
        .file-input-group .btn-file:hover {
            background-color: #e9ecef;
        }

        /* CV List Styling */
        .cv-list-item {
            transition: background-color 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }
        .cv-list-item:last-child {
            border-bottom: none;
        }
        .cv-list-item:hover {
             /* Handled by hover-shadow-sm */
        }
        .format-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
        }
        .btn-ghost-danger {
            color: #adb5bd;
            background: transparent;
            transition: all 0.2s;
        }
        .btn-ghost-danger:hover {
            color: #dc3545;
            background-color: #fee2e2;
        }
        .hover-shadow-sm:hover {
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
            border-color: var(--accent-color) !important;
            transform: translateY(-1px);
            transition: all 0.2s;
        }
        .title-hover:hover span {
            color: var(--accent-color);
            text-decoration: underline;
        }
        .title-hover:hover i {
            opacity: 1 !important;
            color: var(--accent-color) !important;
        }
        .icon-file {
            color: #adb5bd;
            font-size: 1.25rem;
        }
        
        /* Layout Helper */
       .card {
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            height: 100%;
        }
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1.25rem 1.5rem;
        }
    </style>
@endpush

@section('content')
<!-- BEGIN: MainContent -->
<main class="flex-grow-1 py-4 py-md-5" style="min-height: 80vh;">
    <div class="container-xl container px-0">
        <!-- Page Title -->
        <div class="mb-4 flex justify-between items-center">
            <h1 class="h3 fw-bold text-dark">{{ __('cv.manage_cvs') }}</h1>
            <x-client.elements.button type="button" class="h-12 flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" onclick="window.location.href = '{{ route('profile.create-cv') }}'">
                <i class="bi bi-send-plus"></i><span>{{ __('job.txt_create_cv') }}</span>
            </x-client.elements.button>
        </div>

            <div class="row g-4">
                
                <!-- BEGIN: UploadCard -->
                <!-- Left Card: Upload New CV Form -->
                <div class="col-lg-6">
                    <section class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                            <h2 class="h5 fw-bold mb-0 text-dark">{{ __('cv.upload_cv') }}</h2>
                        </div>
                        <div class="card-body p-4">
                            
                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            {{-- Error Message --}}
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                             {{-- Validation Errors --}}
                             @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- CV Name Input Group -->
                                <div class="mb-4">
                                    <label for="cv_name" class="form-label fw-bold text-secondary small">{{ __('cv.cv_name') }} <span class="text-danger">*</span></label>
                                    <div class="input-group file-input-group shadow-sm">
                                        <input type="text" class="form-control" id="cv_name" name="cv_name" placeholder="{{ __('cv.placeholder_cv_name') }}" required>
                                    </div>
                                </div>

                                <!-- Drag and Drop Area -->
                                <div class="mb-4">
                                    <div class="upload-area py-5 px-3 text-center position-relative">
                                         <!-- Real file input (hidden/opacity 0 but works) -->
                                        <input type="file" name="cv_file" id="cv_file" accept=".doc,.docx,.pdf" required onchange="updateFileName(this)">
                                        
                                        <div class="mb-2">
                                            <!-- Cloud Icon -->
                                            <!-- Cloud Icon -->
                                            <i class="ti ti-cloud-upload fs-1 text-secondary" style="font-size: 3em !important;"></i>
                                        </div>
                                        <p class="mb-0 fw-medium text-secondary small" id="file-upload-text">Drag and drop your file here or click to browse</p>
                                        <div class="mb-0 fw-medium text-secondary small mt-2">
                                            {{ __('cv.upload_file_rules') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary-custom w-100 py-2 shadow-sm">
                                    {{ __('cv.upload_cv') }}
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
                <!-- END: UploadCard -->

                <!-- BEGIN: CurrentCVsCard -->
                <!-- Right Card: List of Existing CVs -->
                <div class="col-lg-6">
                    <section class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                            <h2 class="h5 fw-bold mb-0 text-dark">{{ __('cv.your_cv') }}</h2>
                        </div>
                        <div class="card-body d-flex flex-column h-100">
                            
                            <!-- List Container -->
                            <div class="cv-list d-flex flex-column flex-grow-1">
                                
                                @if($cvs->count() > 0)
                                    @foreach($cvs as $cv)
                                        <div class="cv-list-item p-3 mb-2 rounded border hover-shadow-sm d-flex align-items-center justify-content-between bg-white">
                                            <div class="d-flex align-items-center text-truncate pe-3" style="min-width: 0;">
                                                <!-- Icon Container with Color Background -->
                                                <div class="me-3 d-flex align-items-center justify-content-center rounded-3 p-2" 
                                                     style="width: 48px; height: 48px; background-color: {{ $cv->extension == 'pdf' ? '#fee2e2' : ($cv->extension == 'doc' || $cv->extension == 'docx' ? '#e0f2fe' : '#f3f4f6') }};">
                                                    @if($cv->extension == 'pdf')
                                                        <i class="ti ti-file-type-pdf fs-2 text-danger"></i>
                                                    @elseif(in_array($cv->extension, ['doc', 'docx']))
                                                        <i class="ti ti-file-type-doc fs-2 text-primary"></i>
                                                    @else
                                                        <i class="ti ti-file-text fs-2 text-secondary"></i>
                                                    @endif
                                                </div>
                                                
                                                <div class="text-truncate">
                                                     <a href="{{ $cv->url }}" target="_blank" class="fw-bold text-dark text-decoration-none text-truncate d-flex align-items-center gap-2 mb-1 title-hover" title="{{ $cv->document_title }}">
                                                        <span>{{ $cv->document_title }}</span>
                                                        <i class="ti ti-external-link text-muted fs-6 opacity-50"></i>
                                                    </a>
                                                    <div class="d-flex align-items-center text-muted small">
                                                        <i class="ti ti-calendar me-1"></i> {{ $cv->created_at->format('d/m/Y') }}
                                                        <span class="mx-2">•</span>
                                                        <span class="text-truncate" style="max-width: 150px;">{{ $cv->file_name_original }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center flex-shrink-0 gap-3">
                                                 <!-- Format Badge -->
                                                <span class="badge bg-light text-secondary border fw-normal">{{ strtoupper($cv->extension) }}</span>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('cv.delete', $cv->id) }}" method="POST" class="d-inline" onsubmit="return deleteCV(event, '{{ $cv->document_title }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-ghost-danger btn-sm rounded-circle" title="{{ __('cv.delete_cv') }}">
                                                        <i class="ti ti-trash fs-5"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center p-5">
                                        <div class="mb-4">
                                            <img src="{{ asset('files/cv/cv-empty.png') }}" alt="No CVs" class="img-fluid" style="max-width: 120px;margin: auto">
                                        </div>
                                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('cv.no_cv_uploaded_yet') }}</h3>
                                        <p class="text-muted mb-4">{{ __('cv.upload_cv_suggestion') }}</p>
                                        <div class="small text-secondary">
                                            {{ __('cv.upload_file_rules') }}
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </section>
                </div>
                <!-- END: CurrentCVsCard -->

            </div>
        </div>
    </main>
    <!-- END: MainContent -->
@endsection

@push('scripts')
    <script>
    async function deleteCV(e, cvname) {
        e.preventDefault();
        const title = '{{ __('cv.confirm_delete_cv', ['name' => ":cvname"]) }}';
        const confirmResult = await Swal.fire({
            title: title.replace(':cvname', cvname),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ __('cv.confirm') }}',
            cancelButtonText: '{{ __('cv.cancel') }}',
            reverseButtons: true,
        });

        if (confirmResult.isConfirmed) {
            e.target.submit();
        }
    }

    // Optional: Simple script to show selected filename
    function updateFileName(input) {
        if (input.files && input.files[0]) {
            document.getElementById('file-upload-text').innerText = input.files[0].name;
        }
    }
    </script>
@endpush