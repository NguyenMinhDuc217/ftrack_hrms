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
</style>

<section class="py-6 bg-gray-50">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-8">

            <!-- ==================== BÊN TRÁI: CHI TIẾT CÔNG VIỆC ==================== -->
            <div class="lg:col-span-8 flex flex-col gap-4">

                <!-- Card thông tin nhanh + nút ứng tuyển -->
                <div class="flex flex-col gap-3 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
                    <h1 class="text-lg font-bold text-gray-900 mb-4">
                        {{ $job->title }}
                    </h1>

                    <!-- 3 ô thông tin nổi bật -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                                <i class="bi bi-coin text-white text-4xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Thu nhập</p>
                                <p class="font-semibold text-gray-900">
                                    {{ number_format($job->min_salary / 1000000, 1) }} - {{ number_format($job->max_salary / 1000000, 1) }} triệu
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                                <i class="bi bi-geo-alt-fill text-white text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Địa điểm</p>
                                <p class="font-semibold text-gray-900">{{ $job->job_area->first()->province->name ?? '' }} {{ $job->job_area->count() > 1 ? 'và ' . ($job->job_area->count() - 1) . ' nơi khác' : '' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                                <i class="bi bi-hourglass text-white text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kinh nghiệm</p>
                                <p class="font-semibold text-gray-900">{{ $job->experience ?? 'Không yêu cầu' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">
                            Hạn nộp hồ sơ: 
                            <span class="font-bold text-gray-900">
                                {{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}
                            </span>
                            <span class="text-green-600 font-medium">
                                (Còn {{ number_format(\Carbon\Carbon::now()->diffInDays($job->end_date)) }} ngày)
                            </span>
                        </p>
                    </div>
                    <!-- Hạn nộp + Nút ứng tuyển -->
                    <button class="h-12 btn bg-[var(--accent-color)] text-white w-full flex justify-center items-center gap-2 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200" data-bs-toggle="modal" data-bs-target="#applyModal" onclick="saveCurrentUrl()">
                        <i class="bi bi-send-plus"></i><span>Ứng tuyển ngay</span>
                    </button>
                </div>

                <!-- Mô tả công việc -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    <h2 class="text-xl font-bold text-gray-900">Mô tả công việc</h2>
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-line">
                        {!! nl2br(e($job->description_md)) !!}
                    </div>
                </div>

                <!-- Yêu cầu công việc -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    <h2 class="text-xl font-bold text-gray-900">Yêu cầu công việc</h2>
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
                                CPM Việt Nam: The Power of Field Marketing - Bí quyết tăng trưởng doanh số bạn không thể bỏ qua.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-people text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Quy mô</p>
                                <p class="font-semibold">500-2000 nhân viên</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-briefcase text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Lĩnh vực</p>
                                <p class="font-semibold">Marketing Services</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-geo-alt text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Địa điểm</p>
                                <p class="font-semibold text-sm">Tầng 12, Tòa nhà Rosana</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="#" class="inline-flex items-center gap-2 text-green-600 font-bold hover:text-green-700 transition">
                            Xem trang công ty
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky">
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-gray-900">Thông tin tuyển dụng</h3>
                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-people text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Số lượng tuyển dụng</p>
                                <p class="font-semibold">{{ $job->headcount }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-briefcase text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Hình thức làm việc</p>
                                <p class="font-semibold">{{ ($job->employment_type) ? Str::ucfirst($job->employment_type) : '' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($job->job_area->count() > 0)
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-gray-900">Khu vực tuyển dụng</h3>
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
                    Quay lại
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
                                        Ứng tuyển <span class="text-[var(--accent-color)]">{{ $job->title }}</span>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body ">
                                    <div class="flex flex-col gap-3 items-center">
                                        <div class="flex items-center gap-2 w-full">
                                            <i class="bi bi-folder2-open text-lg text-[var(--accent-color)]"></i>
                                            <span class="font-bold">Chọn CV để ứng tuyển</span>
                                        </div>

                                        <!-- Chọn CV có sẵn -->
                                        <div id="collapseChooseCV" class="group-collapse flex flex-col gap-2 w-full border-2 hover:border-[var(--accent-color)] border-gray-200 p-2 rounded-md" data-collapse-group="cv-group">
                                            <button type="button" class="btn border-none hover:text-[var(--accent-color)] w-full p-0" data-bs-toggle="collapse" data-bs-target="#collapseCVList">
                                                <span class="title-collapse">Chọn CV có sẵn</span>
                                            </button>
                                            <div id="collapseCVList" class="flex flex-col gap-2 collapse show">
                                            @if($cvs && $cvs->count() > 0)
                                                @foreach($cvs as $cv)
                                                    <div class="text-decoration-none text-dark w-full d-flex align-items-center justify-content-between p-3 border-2 rounded bg-light hover:border-[var(--accent-color)] cursor-pointer">
                                                        <a href="{{ $cv->url }}" target="_blank" class="mb-0 fw-bold">{{ $cv->document_title }}</a>
                                                        <span onclick="chooseCV({{ $cv->id }}, this )" class="cv-select-btn btn bg-[var(--accent-color)] text-white hover:outline-[var(--accent-color)] hover:border-2 hover:border-[var(--accent-color)] hover:bg-transparent hover:!text-[var(--accent-color)] hover:cursor-pointer">Chọn CV</span>
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
                                                <span class="title-collapse">Tạo CV mới</span>
                                            </button>
                                            <div id="collapseUploadCV" class="flex flex-col gap-2 collapse">
                                                <div class="mb-3">
                                                    <label for="cv_name" class="form-label fw-bold">{{ __('cv.cv_name') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="cv_name" name="cv_name" placeholder="{{ __('cv.placeholder_cv_name') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{ __('cv.upload_cv') }}</label>
                                                    <div class="input-group">
                                                        <input type="file" name="cv_file" id="cv_file" class="form-control" accept=".doc,.docx,.pdf">
                                                        <button type="button" onclick="uploadCV()" class="btn btn-primary">
                                                            <i class="ti ti-upload me-2"></i> {{ __('cv.upload_cv') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="user_document_id">
                                                <small class="text-muted">{{ __('cv.upload_file_rules') }}</small>
                                            </div>
                                        </div>

                                        <div class="w-full">
                                            <div class="mb-3">
                                                <label for="province_code" class="form-label fw-bold">Khu vực đang tuyển dụng <span class="text-danger">*</span></label>
                                                <select name="province_code" id="province_code" class="form-select" required>
                                                    <option value="">Tỉnh thành</option>
                                                    @foreach ($job->job_area as $area)
                                                            <option value="{{ $area->province->code }}">{{ $area->province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer grid grid-cols-5 justify-center items-center gap-2">
                                    <button type="submit" class="col-span-4 h-12 btn bg-[var(--accent-color)] text-white flex justify-center items-center gap-2 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200">Nộp hồ sơ ứng tuyển</button>
                                    <button type="button" class="col-span-1 h-12 btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        @if(session('success'))
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
        @endif
        @if(session('error'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
        @endif
    </script>

    <script>
        $(document).ready(function() {
           $('#applyModal').modal('show'); 
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
        });

        // Lưu URL hiện tại vào sessionStorage
        function saveCurrentUrl() {
            sessionStorage.setItem('job_apply_url', window.location.href);
        }

        // Sau khi login xong sẽ tự động mở
        document.addEventListener('DOMContentLoaded', function () {
            const applyUrl = sessionStorage.getItem('job_apply_url');
        
            if (applyUrl && window.location.href === applyUrl) {
                var modal = new bootstrap.Modal(document.getElementById('applyModal'));
                modal.show();
                sessionStorage.removeItem('job_apply_url');
            }
        });

        function uploadCV() {
            const formData = new FormData();
            formData.append('cv_file', $('#cv_file')[0].files[0]);
            formData.append('cv_name', $('#cv_name').val());
            var url = '{{ route('cv.upload') }}';
            console.log(url)
            
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        if (response.data) {
                            $('#user_document_id').val(response.data.id);
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
        }

    </script>
</section>

@endsection