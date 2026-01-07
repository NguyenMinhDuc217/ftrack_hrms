<div class="modal fade" id="CreateCVModal" tabindex="-1" aria-labelledby="createFirstCvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lg:max-w-[40%]">
        <div class="modal-content overflow-hidden">
            <div class="modal-header border-0 pb-3 bg-black text-white">
                <h3 class="modal-title text-xl font-bold w-full text-center text-white">
                    🎉 {{ __('cv.txt_welcome') }}
                </h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center flex flex-col items-center gap-2">
                    <i class="bi bi-file-earmark-person text-6xl text-black"></i>
                    <h4 class="text-lg font-bold text-gray-800">
                        {{ __('cv.txt_you_not_cv') }}
                    </h4>
                    <p class="text-gray-600 text-lg">
                        {{ __('cv.txt_create_cv_des') }}
                    </p>
                </div>

                <div class="space-y-5">
                    <!-- Upload CV nhanh -->
                    <form action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="cv_name" class="form-label fw-bold">{{ __('cv.cv_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cv_name" name="cv_name" placeholder="{{ __('cv.placeholder_cv_name') }}">
                            @error('cv_name')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label id="uploadArea" for="cv_files" class="w-full mb-3 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[var(--accent-color)] transition cursor-pointer bg-gray-50">
                            <i class="bi bi-cloud-upload text-4xl text-gray-400 mb-4"></i>
                            <p class="font-semibold text-gray-700 mb-2">{{ __('job.txt_update_cv_available') }}</p>
                            <p class="text-sm text-gray-500">{{ __('cv.txt_support_type_file')}}</p>

                            <div id="cvPreview" class="mt-3 text-center text-sm text-gray-500 hidden">
                                <i class="bi bi-file-check text-green-600 me-2"></i>
                                <span id="selectedFileName"></span>
                            </div>

                        </label>
                        <input type="file" name="cv_file" id="cv_files" class="hidden" accept=".doc,.docx,.pdf" >
                        @error('cv_file')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="submit" class="btn rounded-0 bg-black text-white hover:!bg-white hover:!text-black hover:border-2 hover:border-black w-full">{{ __('job.txt_create_cv') }}</button>
                    </form>

                    <!-- Bỏ qua tạm thời -->
                    <div class="text-center mt-8">
                        <button type="button" class="text-gray-500 hover:text-gray-700 underline" data-bs-dismiss="modal">
                            {{ __('cv.txt_skip_create_cv') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Đặt id cv_files tránh trùng với input tương tự trong job detail
        $('#cv_files').on('change', function(e) {
            
            const fileInput = this;
            const file = fileInput.files[0];
            const uploadArea = $('#uploadArea');
            const cvPreview = $('#cvPreview');
            const selectedFileName = $('#selectedFileName');

            if (file) {
                uploadArea.removeClass('border-gray-300').removeClass('bg-gray-50').addClass('border-[var(--accent-color)] bg-teal-50'); 
                cvPreview.removeClass('hidden');
                
                selectedFileName.text(file.name);
            } else {
                uploadArea.addClass('border-gray-300').addClass('bg-gray-50');
                uploadArea.removeClass('border-[var(--accent-color)] bg-teal-50');
                cvPreview.addClass('hidden');
                selectedFileName.text('');
            }
        });
       
    })
</script>