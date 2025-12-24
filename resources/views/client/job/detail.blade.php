@extends('layouts.client')

@section('title', __('cv.profile'))

@section('content')

<style>
    #applyModal .modal-body {
        max-height: 50vh;
        overflow-y: scroll;
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    #applyModal .modal-body::-webkit-scrollbar {
        display: none;
    }

    .collapse { 
        border-width: 0 !important;
        visibility: inherit !important;
    }

    .cv-item-active {
        background-color: #d4ffc3 !important;
        border: solid 2px #ffffff !important;
    }
    .cv-item-active:hover {
        background-color: var(--accent-color) !important;
        color: #ffffff !important;
    }
</style>

<section class="py-6 bg-gray-50">
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-8">

            <!-- ==================== BÊN TRÁI: CHI TIẾT CÔNG VIỆC ==================== -->
            <div class="lg:col-span-8 flex flex-col gap-4">

                <!-- Card thông tin nhanh + nút ứng tuyển -->
                <div class="flex flex-col gap-3 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
                    <h1 class="text-lg font-bold text-gray-900 mb-4">
                        {{ $job->name }}
                    </h1>

                    <!-- 3 ô thông tin nổi bật -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                                <i class="bi bi-coin text-white text-4xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_income') }}</p>
                                <p class="font-semibold text-gray-900">
                                    {{ __('job.txt_salary_rank', ['min' => number_format($job->min_salary / 1000000, 1), 'max' => number_format($job->max_salary / 1000000, 1)]) }}
                                   
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                                <i class="bi bi-geo-alt-fill text-white text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_location') }}</p>
                                <p class="font-semibold text-gray-900">{{ $job->job_area->first()->province->name ?? '' }} {{ $job->job_area->count() > 1 ? 'và ' . ($job->job_area->count() - 1) . ' ' . __('job.txt_otherwhere') : '' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                                <i class="bi bi-hourglass text-white text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_experience') }}</p>
                                <p class="font-semibold text-gray-900">{{ $job->experience ? str_replace('năm', __('job.txt_year'), $job->experience) : __('job.txt_no_experience') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">
                            {{ __('job.txt_apply_deadline') }}: 
                            <span class="font-bold text-gray-900">
                                {{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}
                            </span>
                            <span class="text-green-600 font-medium">
                                @if (!empty($locale) && $locale == 'vi')
                                    ({{ __('job.txt_left') }} {{ number_format(\Carbon\Carbon::now()->diffInDays($job->end_date)) }} {{ __('job.txt_days') }})
                                @elseif (!empty($locale) && $locale == 'en')
                                    ({{ number_format(\Carbon\Carbon::now()->diffInDays($job->end_date)) }} days left)
                                @endif
                            </span>
                        </p>
                    </div>
                    <!-- Hạn nộp + Nút ứng tuyển -->
                    <button class="h-12 btn bg-[var(--accent-color)] text-white w-full flex justify-center items-center gap-2 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200" data-bs-toggle="modal" data-bs-target="#applyModal" onclick="saveCurrentUrl()">
                        <i class="bi bi-send-plus"></i><span>{{ __('job.txt_apply_now') }}</span>
                    </button>
                </div>

                <!-- Mô tả công việc -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ __('job.txt_description') }}</h2>
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-line">
                        {!! nl2br(e($job->description_md)) !!}
                    </div>
                </div>

                <!-- Yêu cầu công việc -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ __('job.txt_requirements') }}</h2>
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-line">
                        {!! nl2br(e($job->requirements_md)) !!}
                    </div>
                </div>

            </div>
            <!-- ==================== HẾT BÊN TRÁI ==================== -->


            <!-- ==================== BÊN PHẢI: THÔNG TIN CÔNG TY ==================== -->
            <div class="lg:col-span-4 flex flex-col gap-4">

                <!-- Card công ty -->
                <div class="flex flex-col gap-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky">
                    <div class="flex items-start gap-4">
                        <img src="https://picsum.photos/id/101/80/80" 
                             alt="Logo công ty" 
                             class="w-20 h-20 rounded-xl object-contain border border-gray-200 shadow-sm flex-shrink-0" />

                        <div class="flex-1 min-w-0">
                            <h3 class="text-xl font-bold text-gray-900">CPM VIETNAM</h3>
                            <!-- <p class="text-sm text-gray-600 mt-1 line-clamp-2"> -->
                            <p class="text-sm text-gray-600 mt-1">
                                {{ __('job.txt_company_des') }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-people text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_scale') }}</p>
                                <p class="font-semibold">500-2000 {{ __('job.txt_employees') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-briefcase text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{__('job.txt_business_field')}}</p>
                                <p class="font-semibold">Marketing Services</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-geo-alt text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_location') }}</p>
                                <p class="font-semibold text-sm">{{ __('job.txt_company_address') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="https://www.facebook.com/CPMVietnam/" target="_blank" class="inline-flex items-center gap-2 text-green-600 font-bold hover:text-green-700 transition">
                            {{ __('job.txt_see_company_page') }}
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky">
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-gray-900">{{ __('job.txt_recruitment_info') }}</h3>
                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-people text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_number_of_recruitment') }}</p>
                                <p class="font-semibold">{{ $job->headcount }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-briefcase text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_form_of_work') }}</p>
                                <p class="font-semibold">{{ ($job->employment_type) ? Str::ucfirst($job->employment_type) : '' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($job->job_area->count() > 0)
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-gray-900">{{ __('job.txt_area_recruitment') }}</h3>
                        <div class="flex flex-wrap items-center gap-1 text-sm text-gray-600 my-2">
                            <i class="text-xl bi bi-geo-alt-fill text-[var(--accent-color)]"></i>
                            @foreach($job->job_area as $area)
                                <span class="p-2 bg-gray-100 rounded-md text-xs">
                                    {{ $area->province->name ?? '' }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Nút Back (chỉ hiện trên mobile) -->
                <a href="{{ url()->previous() }}" 
                   class="lg:hidden inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition">
                    <i class="bi bi-arrow-left"></i>
                    {{ __('default.btn_back') }}
                </a>
            </div>
            <!-- ==================== HẾT BÊN PHẢI ==================== -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered lg:max-w-[40%]">
                <div class="modal-content">

                    @if(Auth::check())
                    <form action="{{ route('apply.job') }}" id="applyForm" method="POST">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                        <input type="hidden" name="cv_id" id="selectedCvId" value="">

                        <div class="modal-header">
                            <h1 class="modal-title text-xl font-bold">
                                {{ __('job.txt_apply') }} <span class="text-[var(--accent-color)]">{{ $job->title }}</span>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body ">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first() }}</li>
                                        </ul>
                                    </div>
                                @endif

                            <div class="flex flex-col gap-3 items-center">
                                <div class="flex items-center gap-2 w-full">
                                    <i class="bi bi-folder2-open text-lg text-[var(--accent-color)]"></i>
                                    <span class="font-bold">{{ __('job.txt_choose_cv_apply') }}</span>
                                </div>

                                <!-- Chọn CV có sẵn -->
                                <div id="collapseChooseCV" class="group-collapse flex flex-col gap-2 w-full border-2 hover:border-[var(--accent-color)] border-gray-200 p-2 rounded-md" data-collapse-group="cv-group">
                                    <button type="button" class="btn border-none hover:text-[var(--accent-color)] w-full p-0" data-bs-toggle="collapse" data-bs-target="#collapseCVList">
                                        <span class="title-collapse">{{__('job.txt_choose_cv_available')}}</span>
                                    </button>
                                    <div id="collapseCVList" class="flex flex-col gap-2 collapse show">
                                    @if($cvs && $cvs->count() > 0)
                                        @foreach($cvs as $cv)
                                            <div id="cv-item-{{ $cv->id }}" class="cv-item text-decoration-none text-dark w-full d-flex align-items-center justify-content-between p-3 border-2 rounded bg-light hover:border-[var(--accent-color)] cursor-pointer">
                                                <a href="{{ $cv->url }}" target="_blank" class="mb-0 fw-bold">{{ $cv->document_title }}</a>
                                                <span onclick="chooseCV({{ $cv->id }}, this )" class="cv-select-btn btn bg-[var(--accent-color)] text-white hover:outline-[var(--accent-color)] hover:border-2 hover:border-[var(--accent-color)] hover:bg-transparent hover:!text-[var(--accent-color)] hover:cursor-pointer">{{__('job.txt_choose_cv')}}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-secondary mb-4">
                                            <i class="ti ti-file-off me-2"></i> {{ __('cv.no_cv_attached') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <!-- Tạo CV mới -->
                                <div id="collapseCreateCV" class="group-collapse w-full border-2 border-dashed hover:border-[var(--accent-color)] border-gray-200 rounded-md" data-collapse-group="cv-group">
                                    <button type="button" class="btn border-none hover:text-[var(--accent-color)] w-full" data-bs-toggle="collapse" data-bs-target="#collapseUploadCV">
                                        <span class="title-collapse">{{__('job.txt_create_new_cv')}}</span>
                                    </button>
                                    <div id="collapseUploadCV" class="flex flex-col gap-2 collapse mx-2 mb-2">
                                        <div class="">
                                            <label for="cv_name" class="form-label fw-bold">{{ __('cv.cv_name') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cv_name" name="cv_name" placeholder="{{ __('cv.placeholder_cv_name') }}">
                                        </div>
                                        <div class="">
                                            <label class="form-label fw-bold">{{ __('cv.upload_cv') }}</label>
                                            <div class="input-group">
                                                <input type="file" name="cv_file" id="cv_file" class="form-control" accept=".doc,.docx,.pdf">
                                                <button type="button" onclick="uploadCV()" class="btn btn-success">
                                                    <i class="ti ti-upload me-2"></i> {{ __('cv.upload_cv') }}
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="user_document_id">
                                        <small class="text-muted">{{ __('cv.upload_file_rules') }}</small>
                                    </div>
                                </div>

                                @if($checkPhone == false)
                                <div class="w-full">
                                    <label for="province_id" class="form-label text-danger fw-bold">{{ __('user.txt_please_fill_phone_number') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="{{ __('user.txt_phone_number') }}">
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                <div class="w-full">
                                    <div class="mb-3">
                                        <label for="province_id" class="form-label fw-bold">{{__('job.txt_area_recruitment')}} <span class="text-danger">*</span></label>
                                        <select name="province_id" id="province_id" class="form-select" required>
                                            <option value="">{{__('job.txt_province')}}</option>
                                            @foreach ($job->job_area as $area)
                                                    <option value="{{ $area->province->id }}">{{ $area->province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer grid grid-cols-5 justify-center items-center gap-2">
                            <button type="submit" class="col-span-4 h-12 btn bg-[var(--accent-color)] text-white flex justify-center items-center gap-2 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200">{{__('job.txt_apply')}}</button>
                            <button type="button" class="col-span-1 h-12 btn btn-secondary" data-bs-dismiss="modal">{{__('default.btn_close')}}</button>
                        </div>
                    </form>
                    @else
                    <x-client.login/>
                    @endif

                </div>
            </div>
        </div>

    </div>


    <script>
        $(document).ready(function() {
            $('#collapseChooseCV').addClass('border-[var(--accent-color)] shadow-md').find('.title-collapse').addClass('font-semibold text-[var(--accent-color)] underline');

            $(document).on('show.bs.collapse', '.collapse', function () {
                var $this = $(this);
                var group = $this.closest('.group-collapse');
                var title = group.find('.title-collapse');

                // Đóng tất cả collapse khác trong cùng group
                $('.collapse').not(this).collapse('hide');
                $('.collapse .title-collapse').removeClass('font-semibold text-[var(--accent-color)] underline');

                // Thêm class active cho khối cha đang mở
                $('.group-collapse').removeClass('border-[var(--accent-color)] shadow-md');
                $this.closest('.group-collapse')
                    .addClass('border-[var(--accent-color)] shadow-md')
                    .find('.title-collapse')
                    .addClass('font-semibold text-[var(--accent-color)] underline')
            });

            // Khi collapse đóng xong → bỏ viền + xoay icon về
            $(document).on('hidden.bs.collapse', '.collapse', function () {
                var $parent = $(this).closest('.group-collapse');
                $parent.removeClass('border-[var(--accent-color)] shadow-md');
                $parent.find('.title-collapse').removeClass('font-semibold text-[var(--accent-color)] underline');
            });

            // Xóa required khi collapse đóng
            $(document).on('hidden.bs.collapse', '#collapseUploadCV', function () {
                $(this).find('input[required]').removeAttr('required');
            });
            // Thêm required khi collapse mở
            $(document).on('show.bs.collapse', '#collapseUploadCV', function () {
                $(this).find('#cv_name, #cv_file').attr('required', 'required');
            });

            $('#applyModal').on('hidden.bs.modal', function(){
                window.location.reload();
            }); 
        });

        // Lưu URL hiện tại vào sessionStorage
        function saveCurrentUrl() {
            sessionStorage.setItem('job_apply_url', window.location.href);
        }

        // Sau khi login xong sẽ tự động mở
        document.addEventListener('DOMContentLoaded', function () {
            const applyUrl = sessionStorage.getItem('job_apply_url');
            var checkPhone = @json($checkPhone);
            
            @if(session('applied_successfully'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ __('job.apply_success') }}',
                });
                sessionStorage.removeItem('job_apply_url');
            @else
                if(applyUrl && applyUrl === window.location.href) {
                    var modal = new bootstrap.Modal(document.getElementById('applyModal'));
                    modal.show();
                    if (checkPhone) {
                        sessionStorage.removeItem('job_apply_url');
                    }
                }
            @endif
        });

        function uploadCV() {
            const formData = new FormData();
            formData.append('cv_file', $('#cv_file')[0].files[0]);
            formData.append('cv_name', $('#cv_name').val());
            var url = '{{ route('cv.upload') }}';
            
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response)
                    if (response.success) {
                        if (response.data) {

                            $('#selectedCvId').val(response.data.id);
                        }
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function chooseCV(cvId, element) {
            $(element).hide();
            $('.cv-select-btn').not(element).show();
            $('#selectedCvId').val(cvId);
            $('.cv-item').removeClass('cv-item-active');
            $('#cv-item-' + cvId).addClass('cv-item-active');
        }

    </script>
</section>

@endsection