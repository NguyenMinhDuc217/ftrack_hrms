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

                    @if($cv)
                        <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-4 bg-light">
                            <div class="d-flex align-items-center">
                                @if($cv->extension == 'pdf')
                                    <i class="ti ti-file-type-pdf fs-1 text-danger me-3"></i>
                                @elseif(in_array($cv->extension, ['doc', 'docx']))
                                    <i class="ti ti-file-type-doc fs-1 text-primary me-3"></i>
                                @else
                                    <i class="ti ti-file-text fs-1 text-secondary me-3"></i>
                                @endif
                                <div>
                                    <h6 class="mb-0 fw-bold"><a href="{{ $cv->url }}" target="_blank" class="text-decoration-none text-dark">{{ $cv->file_name_original }}</a></h6>
                                    <small class="text-muted">{{ __('cv.uploaded') }} {{ $cv->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            
                            <form action="{{ route('cv.delete', $cv->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('cv.confirm_delete_cv') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="{{ __('cv.delete_cv') }}">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-secondary mb-4">
                            <i class="ti ti-file-off me-2"></i> {{ __('cv.no_cv_attached') }}
                        </div>
                    @endif

                    <form action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                             <input type="file" name="cv_file" id="cv_file" class="d-none" onchange="this.form.submit()" accept=".doc,.docx,.pdf">
                             <button type="button" class="btn btn-outline-danger fw-bold px-4 py-2" onclick="document.getElementById('cv_file').click()">
                                <i class="ti ti-upload me-2"></i> {{ __('cv.upload_cv') }}
                             </button>
                        </div>
                        <small class="text-muted">{{ __('cv.upload_file_rules') }}</small>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
