@extends('layouts.admin')

@section('title', 'Admin Dashboard - Organization')
@section('page_title', 'Organization')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('org.txt_add_org') }}</h3>
            </div>

           

            <form action="{{ route('admin.orgs.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @if (isset($org))
                @method('PATCH')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label" for="image">{{ __('org.txt_logo') }}</label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card @error('image') is-invalid @enderror">
                                    <div class="card-body">

                                        <div id="existing-images" class="d-flex flex-wrap gap-2 mt-3">
                                            <div class="image-preview-container position-relative">
                                                <img src="{{ asset('images/profile/blank-profile.svg') }}" class="img-thumbnail object-fit-contain" id="logo-preview" style="height: 100px !important; width: 100px;">
                                                <i class="ti ti-camera position-absolute top-0 end-0 bg-primary p-1 text-sm text-white rounded-circle" onclick="document.getElementById('image-input').click()"></i>
                                            </div>
                                        </div>          

                                        <!-- Input ẩn để Dropzone gán file vào (Tên là images[]) -->
                                        <input type="file" name="image" id="image-input" onchange="previewAvatar(this)" class="d-none" accept="image/*">

                                         @error('image')
                                         <div class="text-danger mt-2" role="alert" style="font-size: 0.875em;">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">{{ __('org.txt_name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="{{ __('org.txt_name') }}" id="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.maxlength_set_to_characters', ['length' => 100]) }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">{{ __('org.txt_slug') }}</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                            placeholder="{{ __('org.txt_slug') }}" id="slug" value="{{ old('slug') }}">
                        @error('slug')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.maxlength_set_to_characters', ['length' => 100]) }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('org.txt_description') }}</label>
                        <textarea name="description" id="editor-description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('org.txt_link') }}</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" name="link"
                            placeholder="{{ __('org.txt_link') }}" id="link" value="{{ old('link') }}">
                        @error('link')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_business_field') }}</label>
                        <input type="text" class="form-control @error('business_field') is-invalid @enderror" name="business_field"
                            placeholder="{{ __('job.txt_business_field') }}" id="business_field" value="{{ old('business_field') }}">
                        @error('business_field')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('org.txt_email') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="{{ __('org.txt_email') }}" id="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="example-max-length">{{ __('org.txt_phone_number') }}</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                            name="phone_number" id="tel"
                            aria-describedby="bouncer-error_tel" aria-invalid="true" value="{{ old('phone_number') }}">
                        @error('phone_number')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small class="form-text text-muted">09xxxxxxxx</small>
                        <small>maxlength set to 10 or 11 numbers</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="example-max-length">{{ __('org.txt_address') }}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address" id="address" value="{{ old('address') }}">
                        @error('address')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small class="form-text text-muted">60 Nguyen Dinh Chieu</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="example-max-length">{{ __('org.txt_workforce_size') }} ({{ __('org.txt_people') }})</label>
                        <input type="text" class="form-control @error('workforce_size') is-invalid @enderror"
                            name="workforce_size" id="workforce_size" value="{{ old('workforce_size') }}">
                        @error('workforce_size')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small class="form-text text-muted">50-100</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_status') }}</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">-{{ __('user.txt_status') }}-</option>
                            <option value="active" selected @selected(old('status') == 'active')>{{ __('default.txt_active') }}</option>
                            <option value="inactive" @selected(old('status') == 'inactive')>{{ __('default.txt_inactive') }}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-2">{{ __('default.button_confirm') }}</button>
                    <button type="reset" class="btn btn-light">{{ __('default.button_reset') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    let descEditor; 
    (function () {
        ClassicEditor.create(document.querySelector('#editor-description'), {
            simpleUpload: {
            // Đường dẫn route xử lý upload ảnh
            uploadUrl: "{{ route('admin.upload.editor.image') }}",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
        })
        .then(editor => {
            descEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });
    })();
</script>
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script> 
@endsection