<div class="modal fade" id="CreateCVModal" tabindex="-1" aria-labelledby="createFirstCvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable lg:max-w-[50%]">
        <div class="modal-content overflow-hidden">
            <div class="modal-header border-0 pb-3 bg-black text-white">
                <h3 class="modal-title text-xl font-bold w-full text-center text-white">
                    🎉 {{ __('cv.txt_welcome') }}
                </h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body space-y-4 px-4">
                <div class="text-center flex flex-col items-center gap-2">
                    <h4 class="text-lg font-bold text-gray-800">
                        {{ __('cv.txt_choose_path_create_cv') }}
                    </h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <button class="group relative flex flex-col gap-2 p-2 text-left border-2 border-[var(--blue-color)] bg-primary/5 rounded-lg transition-all hover:shadow-md">
                        <div class="absolute top-2 right-2 text-[var(--blue-color)]">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="w-10 h-10 bg-[var(--blue-color)] rounded-lg flex items-center justify-center text-white">
                            <i class="bi bi-file-earmark-arrow-up"></i>
                        </div>
                        <div>
                            <h3 class="text-[#0d141b]  text-lg font-bold leading-tight">{{ __('job.txt_upload_cv') }}</h3>
                            <span class="text-slate-500 dark:text-slate-400 text-sm font-normal mt-1">{{ __('cv.txt_upload_cv_des') }}</span>
                        </div>
                    </button>

                    <button class="group flex flex-col gap-2 p-2 text-left border-2 border-gray-300 hover:border-[var(--accent-color)] rounded-lg transition-all hover:shadow-md bg-white dark:bg-slate-800" onclick="window.location.href='{{ route('profile.create-cv') }}'">
                        <div class="w-10 h-10 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-300 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                            <i class="bi bi-stars"></i>
                        </div>
                        <div>
                            <h3 class="text-[#0d141b]  text-lg font-bold leading-tight">{{ __('job.txt_create_cv') }}</h3>
                            <span class="text-slate-500 dark:text-slate-400 text-sm font-normal mt-1">{{ __('cv.txt_create_cv_des') }}</span>
                        </div>
                    </button>
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
                        <label id="uploadArea" for="cv_files" class="w-full mb-3 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-[var(--accent-color)] transition cursor-pointer bg-gray-50 flex flex-col">
                            <i class="bi bi-cloud-upload text-4xl text-gray-400"></i>
                            <span class="font-semibold text-gray-500">{{ __('job.txt_update_cv_available') }}</span>
                            <span class="text-sm text-gray-500">{{ __('cv.txt_support_type_file')}}</span>

                            <div id="cvPreview" class="mt-3 text-center text-sm text-gray-500 hidden">
                                <i class="bi bi-file-check text-green-600 me-2"></i>
                                <span id="selectedFileName"></span>
                            </div>

                        </label>
                        <input type="file" name="cv_file" id="cv_files" class="hidden" accept=".doc,.docx,.pdf">
                        @error('cv_file')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                        <x-client.elements.button type="submit" class="h-12 w-full " id="uploadCv">
                            <span>{{ __('job.txt_upload_cv') }}</span>
                        </x-client.elements.button>

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