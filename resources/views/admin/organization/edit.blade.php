@extends('layouts.admin')

@section('title', 'Admin Dashboard - Organization')
@section('page_title', 'Organization')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('org.txt_edit_org') }}</h3>
            </div>

           

            <form action="{{ route('admin.orgs.update', $org) }}" id="org-edit-form" method="POST" class="form-horizontal" enctype="multipart/form-data">
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

                                        @php $img = $org->image @endphp
                                        <div id="existing-images" class="d-flex flex-wrap gap-2 mt-3">
                                            <div class="image-preview-container position-relative">
                                                <img src="{{ $img ? $img->url : asset('images/profile/blank-profile.svg') }}" class="img-thumbnail object-fit-contain" id="logo-preview" style="height: 100px !important; width: 100px;">
                                                <i class="ti ti-camera position-absolute top-0 end-0 bg-primary p-1 text-sm text-white rounded-circle" onclick="document.getElementById('image-input').click()"></i>
                                            </div>
                                        </div>          

                                        <!-- Input ẩn để Dropzone gán file vào (Tên là images[]) -->
                                        <input type="file" name="image" id="image-input" onchange="previewAvatar(this)" value="{{ $img ? $img->url : '' }}" class="d-none is-invalid" accept="image/*">

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
                            placeholder="{{ __('org.txt_name') }}" id="name" value="{{ $org->name }}">
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
                            placeholder="{{ __('org.txt_slug') }}" id="slug" value="{{ $org->slug }}">
                        @error('slug')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.maxlength_set_to_characters', ['length' => 100]) }}</small>
                    </div>


                    <div class="form-group" >
                        <label class="form-label">{{ __('job.txt_description') }}</label>
                        <div id="description-editor">
                            {!! $org->description !!}
                        </div>
                        <input type="hidden" name="description" id="description_hidden">
                        @error('description')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('org.txt_link') }}</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" name="link"
                            placeholder="{{ __('org.txt_link') }}" id="link" value="{{ $org->link }}">
                        @error('link')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_business_field') }}</label>
                        <input type="text" class="form-control @error('business_field') is-invalid @enderror" name="business_field"
                            placeholder="{{ __('job.txt_business_field') }}" id="business_field" value="{{ $org->business_field }}">
                        @error('business_field')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('org.txt_email') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="{{ __('org.txt_email') }}" id="email" value="{{ $org->email }}">
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
                            aria-describedby="bouncer-error_tel" aria-invalid="true" value="{{$org->phone_number}}">
                        @error('phone_number')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small class="form-text text-muted">09xxxxxxxx</small>
                        <small>maxlength set to 10 numbers</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="example-max-length">{{ __('org.txt_address') }}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address" id="address" value="{{$org->address}}">
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
                            name="workforce_size" id="workforce_size" value="{{ $org->workforce_size }}">
                        @error('workforce_size')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small class="form-text text-muted">50-100</small>
                    </div>

                    <div class="d-flex justify-between items-center gap-4">
                        <div class="flex-fill my-0 form-group">
                            <label class="form-label" for="example-max-length">{{ __('org.txt_latitude') }}</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                name="latitude" id="latitude" value="{{ $org->latitude }}">
                            @error('latitude')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <small class="form-text text-muted">10.779911075314716</small>
                        </div>
                        <div class="flex-fill my-0 form-group">
                            <label class="form-label" for="example-max-length">{{ __('org.txt_longitude') }}</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                name="longitude" id="longitude" value="{{ $org->longitude }}">
                            @error('longitude')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <small class="form-text text-muted">106.69901703295604</small>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_status') }}</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="" disabled selected>-{{ __('user.txt_status') }}-</option>
                            <option value="active" @selected($org->status == 'active')>{{ __('default.txt_active') }}</option>
                            <option value="inactive" @selected($org->status == 'inactive')>{{ __('default.txt_inactive') }}</option>
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
    const form = document.getElementById('org-edit-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const description = quill.root.innerHTML;
        $('#description_hidden').val(description);


        form.submit();
    })
</script>
<script>
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link', 'image', 'video', 'formula'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];

    const quill = new Quill('#description-editor', {
        modules: {
            toolbar: {
                container: toolbarOptions,
                handlers: {
                    image: function() {
                        imageHander(this.quill);
                    },
                },
            },
            resize: {
            embedTags: ["VIDEO", "IFRAME"],
            tools: [
                {
                text: "Alt",
                attrs: {
                    title: "Set image alt",
                    class: "btn-alt",
                },
                verify(activeEle) {
                    return activeEle && activeEle.tagName === "IMG";
                },
                handler(evt, button, activeEle) {
                    let alt = activeEle.alt || "";
                    alt = window.prompt("Alt for image", alt);
                    if (alt == null) return;
                    activeEle.setAttribute("alt", alt);
                },
                },
            ],
            },
        },
        theme: 'snow'
    });

    function imageHander(quillInstance) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';

        input.addEventListener('change', async function(e) {
            const file = input.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('upload', file);
                formData.append('type', 'org');

                try {
                    const response = await fetch('{{ route("admin.files.upload-editor-image") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                   
                    const imageUrl = data.url;

                   // Lấy vị trí con trỏ hiện tại trong editor
                    const range = quillInstance.getSelection();
                    // Chèn hình ảnh vào đúng vị trí đó
                    quillInstance.insertEmbed(range ? range.index : 0, 'image', imageUrl);
                    
                    // Di chuyển con trỏ xuống sau hình ảnh
                    quillInstance.setSelection((range ? range.index : 0) + 1);

                }  catch (error) {
                    console.error('Error:', error);
                    alert('Lỗi upload: ' + error.message);
                }
            };
        });

        input.click();
    }

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