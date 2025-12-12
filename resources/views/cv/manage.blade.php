@extends('layouts.client')

@section('title', __('cv.manage_cvs'))

@section('content')
<div class="container pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-3">{{ __('cv.manage_cvs') }}</h3>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">{{ __('cv.your_cv') }}</h5>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @error('cv_file')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    @if($cvs->count() > 0)
                        @foreach($cvs as $cv)
                            <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-3 bg-light">
                                <div class="d-flex align-items-center">
                                    @if($cv->extension == 'pdf')
                                        <i class="ti ti-file-type-pdf fs-1 text-danger me-3"></i>
                                    @elseif(in_array($cv->extension, ['doc', 'docx']))
                                        <i class="ti ti-file-type-doc fs-1 text-primary me-3"></i>
                                    @else
                                        <i class="ti ti-file-text fs-1 text-secondary me-3"></i>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold">
                                            <a href="{{ $cv->url }}" target="_blank" class="text-decoration-none text-dark">{{ $cv->document_title }}</a>
                                        </h6>
                                        <div class="text-muted small">
                                            <span class="me-2"><i class="ti ti-calendar me-1"></i>{{ $cv->created_at->format('d/m/Y') }}</span>
                                            <span><i class="ti ti-file me-1"></i>{{ $cv->file_name_original }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <form action="{{ route('cv.delete', $cv->id) }}" method="POST" class="d-inline" onsubmit="return deleteCV(event, '{{ $cv->document_title }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="{{ __('cv.delete_cv') }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <div class="text-secondary mb-4">
                            <i class="ti ti-file-off me-2"></i> {{ __('cv.no_cv_attached') }}
                        </div>
                    @endif

                    <form action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="cv_name" class="form-label fw-bold">{{ __('cv.cv_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cv_name" name="cv_name" placeholder="{{ __('cv.placeholder_cv_name') }}" required>
                        </div>
                        <div class="mb-3">
                             <label class="form-label fw-bold">{{ __('cv.upload_cv') }}</label>
                             <div class="input-group">
                                <input type="file" name="cv_file" id="cv_file" class="form-control" accept=".doc,.docx,.pdf" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-upload me-2"></i> {{ __('cv.upload_cv') }}
                                </button>
                             </div>
                        </div>
                        <small class="text-muted">{{ __('cv.upload_file_rules') }}</small>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    function deleteCV(e, cvname) {
        e.preventDefault();
        const title = '{{ __('cv.confirm_delete_cv', ['name' => ":cvname"]) }}';
        const confirmResult = Swal.fire({
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
    </script>
@endpush