<style>
    .dz-image-preview {
        position: relative;
    }

    .dz-image-preview .dz-remove {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 21;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('job.txt_edit_job') }}</h3>
            </div>

           

            <form action="{{ route('admin.jobs.update', $job) }}" method="POST" id="job-edit-form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @if (isset($job))
                @method('PATCH')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label" for="image">{{ __('job.txt_image') }}</label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div action="../assets/json/file-upload.php" id="multiImageUpload" class="dropzone">
                                            <div class="fallback">
                                                <i class="bi bi-cloud-upload text-4xl text-gray-400 mb-4"></i>
                                            </div>
                                        </div>

                                        @if($job->images()->count() > 0)
                                        <div id="existing-images" class="d-flex flex-wrap gap-2 mt-3">
                                            @foreach($job->images() as $img) <!-- Giả sử bạn có quan hệ images -->
                                                <div class="image-preview-container position-relative" id="old-img-{{ $img->id }}">
                                                    <img src="{{ $img ? $img->url : asset('images/profile/blank-profile.svg') }}" class="img-thumbnail object-fit-contain" style="height: 100px !important; width: 100px;">
                                                    <input type="hidden" name="existing_images[]" value="{{ $img->id }}">
                                                    <i class="ti ti-x position-absolute top-0 end-0 bg-danger p-1  text-sm text-white rounded-circle" onclick="removeOldImage({{ $img->id }})"></i>
                                                </div>
                                            @endforeach
                                        </div>          
                                        @endif

                                        <!-- Input ẩn để Dropzone gán file vào (Tên là images[]) -->
                                        <input type="file" name="images[]" id="real-file-input" multiple class="d-none is-invalid">

                                        @if ($errors->has('images.*'))
                                            @foreach ($errors->get('images.*') as $file_errors)
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $file_errors[0] }}</strong>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('image')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">{{ __('job.txt_title') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="{{ __('job.txt_title') }}" id="name" value="{{ $job->name }}">
                        @error('name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.maxlength_set_to_characters', ['length' => 100]) }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_profession') }}</label>
                        <select onchange="addProfession()" class="form-control @error('profession_ids') is-invalid @enderror" name="profession_id" id="profession_id">
                            <option label="-{{ __('user.txt_profession') }}-"></option>
                            @foreach ($professions as $profession)
                            <option value="{{$profession->profession_id}}" @selected($job->profession_id ==
                                $profession->profession_id)>{{$profession->profession_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('profession_ids'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('profession_ids')[0] }}</strong>
                            </div>
                        @endif

                        <select name="profession_ids[]" multiple style="display: none;" id="profession_hidden">
                            @foreach($job->professions() ?? [] as $profession)
                                <option value="{{ $profession->profession_id }}" @selected(old('profession_id')==$profession->profession_id) selected></option>
                            @endforeach
                        </select>

                        <div id="profession_tags" class="d-flex flex-wrap gap-2 mt-3">
                            @foreach($job->professions() ?? [] as $profession)
                                @if($profession)
                                    <span class="badge rounded-pill bg-success d-flex flex-row align-items-center gap-1 p-2" id="profession_tag_{{ $profession->profession_id }}">
                                        <span class="text-white">{{ $profession->profession_name }}</span>
                                        <button onclick="removeProfession('{{ $profession->profession_id }}')" class="btn btn-sm p-0 text-white rounded-full hover:bg-blue-300 transition d-flex align-items-center justify-content-center">
                                            <i class="ti ti-x"></i>
                                        </button>
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_province') }} ({{  __('job.txt_can_choose_multiple') }})</label>
                        <select onchange="addProvince()" class="form-control @error('province_id') is-invalid @enderror" id="province_id">
                            <option label="-{{ __('job.txt_province') }}-"></option>
                            @foreach ($provinces as $province)
                            <option value="{{$province->id}}" @selected(0 == $province->id)>
                                {{$province->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('province_id')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <select name="province_id[]" multiple style="display: none;" id="area_application_hidden">
                            @foreach($job->job_area ?? [] as $job_area)
                                <option value="{{ $job_area->province->id }}" selected></option>
                            @endforeach
                        </select>

                        <div id="province_tags" class="d-flex flex-wrap gap-2 mt-3">
                            @foreach($job->job_area ?? [] as $job_area)
                                @if($job_area)
                                    <span class="badge rounded-pill bg-success d-flex flex-row align-items-center gap-1 p-2" id="province_tag_{{ $job_area->province->id }}">
                                        <span class="text-white">{{ $job_area->province->name }}</span>
                                        <button onclick="removeProvince('{{ $job_area->province->id }}')" class="btn btn-sm p-0 text-white rounded-full hover:bg-blue-300 transition d-flex align-items-center justify-content-center">
                                            <i class="ti ti-x"></i>
                                        </button>
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_employment_type') }}</label>
                        <select name="employment_type"
                            class="form-control @error('employment_type') is-invalid @enderror">
                            <option value="">-{{ __('user.txt_employment_type') }}-</option>
                            @foreach($employment_types as $key => $value)
                            <option value="{{ $key }}" @selected($job->employment_type == $key)>
                                {{ $value }}
                            </option>
                            @endforeach`
                        </select>
                        @error('employment_type')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_headcount') }}</label>
                        <input type="number" class="form-control @error('headcount') is-invalid @enderror"
                            name="headcount" placeholder="{{ __('job.txt_headcount') }}" value="{{ $job->job_area[0]->headcount }}">
                        @error('headcount')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.enter_a') }} {{ __('default.number') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_description') }}</label>
                        <textarea name="description_md" id="editor-description">{{ $job->description_md }}</textarea>
                        @error('description_md')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_requirements') }}</label>
                        <textarea name="requirements_md" id="editor-requirements">{{ $job->requirements_md }}</textarea>
                        @error('requirements_md')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 my-3">
                        <div class="flex-fill my-0 form-group">
                            <label class="form-label">{{ __('job.txt_min_salary') }}</label>
                            <input type="number" class="form-control @error('min_salary') is-invalid @enderror"
                                name="min_salary" placeholder="{{ __('job.txt_min_salary') }}"
                                value="{{ $job->min_salary }}">
                            @error('min_salary')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <small>{{ __('default.enter_a') }} {{ __('default.number') }}</small>
                        </div>

                        <div class="flex-fill my-0 form-group">
                            <label class="form-label">{{ __('job.txt_max_salary') }}</label>
                            <input type="number" class="form-control @error('max_salary') is-invalid @enderror"
                                name="max_salary" placeholder="{{ __('job.txt_max_salary') }}"
                                value="{{ $job->max_salary }}">
                            @error('max_salary')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <small>{{ __('default.enter_a') }} {{ __('default.number') }}</small>
                        </div>
    
                        <div class="flex-fill my-0 form-group">
                            <label class="form-label">{{ __('job.txt_currency') }}</label>
                            <input type="text" class="form-control @error('currency') is-invalid @enderror" name="currency"
                                placeholder="{{ __('job.txt_currency') }}" value="{{ $job->currency }}">
                            @error('currency')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <small>{{ __('default.enter_a') }} {{ __('default.text') }}</small>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 my-3">
                        <div class="flex-fill form-group my-0">
                            <label class="form-label">Start date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                placeholder="{{ __('job.txt_start_date') }}" value="{{ $job->start_date }}">
                            @error('start_date')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
    
                        <div class="flex-fill form-group my-0">
                            <label class="form-label">End date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                placeholder="{{ __('job.txt_end_date') }}" value="{{ $job->end_date }}">
                            @error('end_date')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('job.txt_experience') }} ({{ __('job.txt_year') }})</label>
                        <input type="text" class="form-control @error('experience') is-invalid @enderror" name="experience"
                            placeholder="{{ __('job.txt_experience') }}" value="{{ $job->experience }}">
                        @error('experience')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('org.txt_org') }}</label>
                        <select name="org_id" class="form-control @error('org_id') is-invalid @enderror">
                            <option value="" disabled selected>-{{ __('org.txt_org') }}-</option>
                            @foreach ($organizations as $organization)
                                <option value="{{ $organization->org_id }}" @selected($job->org_id == $organization->org_id)>{{ $organization->name }}</option>
                            @endforeach
                        </select>
                        @error('org_id')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <small>{{ __('default.enter_a') }} {{ __('default.text') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tags</label>
                        <select name="tag_ids[]" multiple id="tag_select_edit" class="form-control @error('tag_ids') is-invalid @enderror">
                            @if ($tags->count() > 0)
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" @selected(!empty($job->tag_ids) && in_array($tag->id, $job->tag_ids))>{{ $tag->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        @if($errors->has('tag_ids'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('tag_ids')[0] }}</strong>
                            </div>
                        @endif
                        <small>{{ __('job.txt_tag_example') }}</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('user.txt_status') }}</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="" disabled selected>-{{ __('user.txt_status') }}-</option>
                            <option value="1" @selected($job->status == 1)>{{ __('default.txt_active') }}</option>
                            <option value="0" @selected($job->status == 0)>{{ __('default.txt_inactive') }}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button type="reset" class="btn btn-light">Reset</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    let descEditor, reqEditor; 
    (function () {
        ClassicEditor.create(document.querySelector('#editor-description'))
        .then(editor => {
            descEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });
    })();

    (function () {
        ClassicEditor.create(document.querySelector('#editor-requirements'))
        .then(editor => {
            reqEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });
    })();
</script>

<script>
    Dropzone.autoDiscover = false;
    let myDropzone = new Dropzone("#multiImageUpload", {
        url: "{{ route('admin.jobs.update', $job) }}",
        autoProcessQueue: false, // Không cho tự động upload lên URL của dropzone
        uploadMultiple: true,
        parallelUploads: 20,
        paramName: "images", // Tên mảng file
        addRemoveLinks: true,
        dictRemoveFile: "<i class='ti ti-x position-absolute top-0 end-0 bg-danger p-1 text-sm text-white rounded-circle'></i>",
        init: function() {
            let dz = this;
            let form = document.getElementById('job-edit-form');
            let realInput = document.getElementById('real-file-input');
            form.addEventListener("submit", function(e) {
                // Sử dụng DataTransfer để gom file
                const dataTransfer = new DataTransfer();
                
                // Lấy toàn bộ file hiện có trong Dropzone bỏ vào DataTransfer
                dz.getAcceptedFiles().forEach(file => {
                    dataTransfer.items.add(file);
                });

                // Gán danh sách file này vào input file thật
                realInput.files = dataTransfer.files;

                // Đồng bộ CKEditor trước khi submit truyền thống
                if (descEditor) document.querySelector('#editor-description').value = descEditor.getData();
                if (reqEditor) document.querySelector('#editor-requirements').value = reqEditor.getData();

            });
        }
    });

    function removeOldImage(id) {
        document.getElementById('old-img-' + id).remove();
    }
</script>

<script>
$(document).ready(function() {
    $('#tag_select_edit').select2({
        tags: true, // Cho phép tạo tag mới
        tokenSeparators: [',', ' '], // Cho phép tạo tag bằng dấu phẩy hoặc dấu cách
        placeholder: "- Chọn hoặc nhập tags -",
        allowClear: true,
        width: '100%'
    });
});
</script>