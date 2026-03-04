@extends('layouts.client')

@section('title', $job->name . ' - ' . ($job->organization->name ?? 'CPM Vietnam'))

@php
    $seoDescription = Str::limit(strip_tags($job->description_md), 160);
    $shareImage = $job->organization->image->url ?? asset('images/default-share.webp');
    $locale = app()->getLocale();

    $jobPostingSchema = [
        "@context" => "https://schema.org/",
        "@type" => "JobPosting",
        "title" => $job->name,
        "description" => strip_tags($job->description_md),
        "identifier" => [
            "@type" => "PropertyValue",
            "name" => $job->organization->name ?? 'CPM Vietnam',
            "value" => (string)$job->job_id
        ],
        "datePosted" => $job->created_at ? $job->created_at->toIso8601String() : now()->toIso8601String(),
        "validThrough" => \Carbon\Carbon::parse($job->end_date)->toIso8601String(),
        "employmentType" => strtoupper($job->employment_type ?? 'FULL_TIME'),
        "hiringOrganization" => [
            "@type" => "Organization",
            "name" => $job->organization->name ?? 'CPM Vietnam',
            "sameAs" => $job->organization->link ?? url('/'),
            "logo" => $job->organization->image->url ?? asset('images/logo.png')
        ],
        "jobLocation" => [
            "@type" => "Place",
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $job->organization->address ?? '',
                "addressLocality" => $job->job_area->first()->province->name ?? '',
                "addressRegion" => $job->job_area->first()->province->name ?? '',
                "addressCountry" => "VN"
            ]
        ],
        "baseSalary" => [
            "@type" => "MonetaryAmount",
            "currency" => $job->currency ?? 'VND',
            "value" => [
                "@type" => "QuantitativeValue",
                "minValue" => (int)$job->min_salary,
                "maxValue" => (int)$job->max_salary,
                "unitText" => "MONTH"
            ]
        ]
    ];
@endphp

@push('styles')
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="tuyển dụng, việc làm, {{ $job->name }}, {{ $job->organization->name ?? '' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $job->name }} | {{ $job->organization->name ?? 'CPM Vietnam' }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $shareImage }}">

    <script type="application/ld+json">
    @json($jobPostingSchema)
    </script>
    
@endpush

@section('description', $seoDescription)

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
        /* background-color: var(--accent-color) !important; */
        color: var(--blue-color) !important;
    }

    #description-content a[data-fancybox],
    #requirements-content a[data-fancybox] {
        display: inline-block !important;
        vertical-align: middle;
        margin-right: 8px;
        margin-bottom: 8px;
        max-width: 100%;
    }

    #description-content img,
    #requirements-content img {
        display: block !important;
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        cursor: zoom-in;
    }

    #description-content p:has(img),
    #requirements-content p:has(img) {
        display: block;
    }
</style>

<section class="py-6 bg-gray-50">
    @php
    $locale = app()->getLocale();
    @endphp
    <div class="container mx-auto px-0">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-8">

            <!-- ==================== BÊN TRÁI: CHI TIẾT CÔNG VIỆC ==================== -->
            <div class="lg:col-span-8 flex flex-col gap-4">

                <!-- Card thông tin nhanh + nút ứng tuyển -->
                <div class="flex flex-col gap-3 bg-white rounded-lg shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
                    <h1 class="text-lg font-bold text-gray-900 mb-2 alumni-font">
                        {{ $job->name }}
                    </h1>

                    <!-- 3 ô thông tin nổi bật -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-5 pb-6 border-b-2">
                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--blue-color)] flex-shrink-0">
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
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)] flex-shrink-0">
                                <i class="bi bi-people text-white text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_number_of_recruitment') }}</p>
                                <p class="font-semibold text-gray-900">{{ $job->job_area->first()->headcount }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--red-color)] flex-shrink-0">
                                <i class="bi bi-hourglass text-white text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_experience') }}</p>
                                <p class="font-semibold text-gray-900">{{ $job->experience ? trim(str_replace(['năm', 'year', 'years', 'Năm', 'Year', 'Years'], '', $job->experience)) . ' '. __('job.txt_year')  : __('job.txt_no_experience') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">

                        @if($job->job_area->count() > 0)
                        <div class="space-y-2 flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <i class="text-xl bi bi-geo-alt text-gray-600"></i>
                                <p class="text-sm text-gray-600 mt-0">{{ __('job.txt_area_recruitment') }}:</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-1 text-sm text-gray-600 my-2">
                                @foreach($job->job_area as $area)
                                <span class="p-2 bg-gray-100 rounded-md text-xs">
                                    {{ $area->province->localized_name ?? '' }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-briefcase text-gray-600 text-xl"></i>
                                <p class="text-sm text-gray-600">{{ __('job.txt_form_of_work') }}:</p>
                            </div>
                            <div>
                                <span class="font-bold text-xs">{{ ($job->employment_type) ? Str::upper($job->employment_type) : '' }}</span>
                            </div>
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-calendar text-gray-600 text-xl"></i>
                                <p class="text-sm text-gray-600">{{ __('job.txt_apply_deadline') }}: </p>
                            </div>
                            <p class="text-sm text-gray-600">
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
                    </div>

                    <!-- Hạn nộp + Nút ứng tuyển -->
                    <x-client.elements.button type="button" class="h-12 w-full flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" data-bs-toggle="modal" data-bs-target="#applyModal" onclick="saveCurrentUrl()">
                        <i class="bi bi-send-plus"></i><span>{{ __('job.txt_apply_now') }}</span>
                    </x-client.elements.button>
                </div>

                @if($job->images()->count() > 0 && false)
                <div class="image-grid grid grid-cols-3 gap-3">
                    @foreach($job->images() as $index => $img)
                    @if($index < 3)
                        <a href="{{ $img ? $img->url : asset('images/profile/blank-profile.svg') }}"
                        data-fancybox="gallery"
                        class="relative group block overflow-hidden rounded-lg aspect-square border border-gray-100 shadow-sm h-[150px] w-full"
                        data-caption="Image #{{ $index + 1 }}">

                        <img src="{{ $img ? $img->url : asset('images/profile/blank-profile.svg') }}" alt="Job Image {{ $index + 1 }}" class="h-[150px] w-full object-contain transition-transform duration-500 group-hover:scale-110" />

                        @if($index == 2 && $job->images()->count() > 3)
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center transition-colors group-hover:bg-black/40">
                            <span class="text-white text-2xl font-bold">+{{ $job->images()->count() - 3 }}</span>
                        </div>
                        @endif
                        </a>
                        @else
                        {{-- Các ảnh từ thứ 4 trở đi sẽ bị ẩn nhưng vẫn nằm trong gallery để slide --}}
                        <a href="{{ $img ? $img->url : asset('images/profile/blank-profile.svg') }}" data-fancybox="gallery" class="hidden"></a>
                        @endif
                        @endforeach
                </div>
                @endif

                <!-- Mô tả công việc -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                    <h2 class="text-xl font-bold text-gray-900 alumni-font">{{ __('job.txt_description') }}</h2>
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-line" id="description-content">
                        {!! $job->description_md !!}
                    </div>
                </div>

                <!-- Yêu cầu công việc -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                    <h2 class="text-xl font-bold text-gray-900 alumni-font">{{ __('job.txt_requirements') }}</h2>
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-line" id="requirements-content">
                        {!! $job->requirements_md !!}
                    </div>
                </div>

            </div>
            <!-- ==================== HẾT BÊN TRÁI ==================== -->


            <!-- ==================== BÊN PHẢI: THÔNG TIN CÔNG TY ==================== -->
            <div class="lg:col-span-4 flex flex-col gap-4">

                <!-- Card công ty -->
                <div class="flex flex-col gap-3 bg-white rounded-lg shadow-sm border border-gray-100 p-4 sticky">
                    <div class="flex items-start gap-4">
                        <img src="{{ $job->organization->image->url ?? asset('images/profile/blank-profile.svg') }}"
                            alt="Logo công ty"
                            class="w-20 h-20 rounded-lg object-contain border border-gray-200 shadow-sm flex-shrink-0" />

                        <div class="flex-1 min-w-0">
                            <a href="{{ route('client.org.detail', $job->organization) }}">
                                <h3 class="text-xl font-bold text-gray-900 alumni-font">{{ $job->organization->name ?? 'N/A' }}</h3>
                            </a>
                            <div class="text-sm text-gray-600 mt-1">
                                {!! Str::limit($job->organization->description ?? 'N/A', 80) !!}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-people text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_scale') }}</p>
                                <p class="font-semibold">{{ $job->organization->workforce_size . ' ' . __('job.txt_employees') ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-briefcase text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{__('job.txt_business_field')}}</p>
                                <p class="font-semibold">{{ $job->organization->business_field ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <div class="">
                                <i class="w-10 h-10 bi bi-geo-alt text-gray-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('job.txt_location') }}</p>
                                <p class="font-semibold text-sm">{{ $job->organization->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('client.org.detail', $job->organization) }}" target="_blank" class="inline-flex items-center gap-2 text-[var(--blue-color)] font-bold hover:text-green-700 transition">
                            {{ __('job.txt_see_company_page') }}
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered lg:max-w-[40%]">
            <div class="modal-content rounded-lg">

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
                                    <span class="title-collapse text-black">{{__('job.txt_choose_cv_available')}}</span>
                                </button>
                                <div id="collapseCVList" class="flex flex-col gap-2 collapse show">
                                    @if($cvs && $cvs->count() > 0)
                                    @foreach($cvs as $cv)
                                    <div id="cv-item-{{ $cv->id }}" class="cv-item text-decoration-none text-dark w-full d-flex align-items-center justify-content-between p-3 border-2 rounded bg-light hover:border-[var(--accent-color)] cursor-pointer">
                                        <a href="{{ $cv->url }}" target="_blank" class="mb-0 fw-bold underline">{{ $cv->document_title }}</a>
                                        <x-client.elements.button type="button" class="cv-select-btn" onclick="chooseCV({{ $cv->id }}, this )">
                                            {{__('job.txt_choose_cv')}}
                                        </x-client.elements.button>
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
                                    <span class="title-collapse text-black">{{__('job.txt_create_new_cv')}}</span>
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

                                            <x-client.elements.button type="button" class="!rounded-r-[var(--bs-border-radius)]" onclick="uploadCV()">
                                                <i class="ti ti-upload me-2"></i> {{ __('cv.upload_cv') }}
                                            </x-client.elements.button>
                                        </div>
                                        <span class="text-danger" id="cv_file_error"></span>
                                    </div>
                                    <input type="hidden" id="user_document_id">
                                    <small class="text-muted">{{ __('cv.upload_file_rules') }}</small>
                                </div>
                            </div>

                            <!-- @if($checkPhone == false)
                            <div class="w-full">
                                <label for="province_id" class="form-label text-danger fw-bold">{{ __('user.txt_please_fill_phone_number') }} <span class="text-danger">*</span></label>
                                <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="{{ __('user.txt_phone_number') }}">
                                @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif -->

                    <div class="invalid-note"></div>


                            <div class="w-full">
                                <div class="mb-3">
                                    <label for="province_id" class="form-label fw-bold">{{__('job.txt_area_recruitment')}} <span class="text-danger">*</span></label>
                                    <select name="province_id" id="province_id" class="form-select" required>
                                        <option value="">{{__('job.txt_province')}}</option>
                                        @foreach ($job->job_area as $area)
                                        <option value="{{ $area->province->id }}">{{ $area->province->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-note"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="mb-3 col-span-1">
                                        <label for="province_id" class="form-label fw-bold">{{__('job.txt_current_salary')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="current_salary" id="current_salary" class="form-control" placeholder="{{ __('job.txt_current_salary') }}">
                                        <div class="invalid-note"></div>
                                    </div>
                                    <div class="mb-3 col-span-1">
                                        <label for="province_id" class="form-label fw-bold">{{__('job.txt_expected_salary')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="expected_salary" id="expected_salary" class="form-control" placeholder="{{ __('job.txt_expected_salary') }}">
                                        <div class="invalid-note"></div>
                                    </div>
                                    <div class="mb-3 col-span-1">
                                        <label for="province_id" class="form-label fw-bold">{{__('job.txt_expected_start_date')}} <span class="text-danger">*</span></label>
                                        <input type="date" name="expected_start_date" id="expected_start_date" class="form-control" placeholder="{{ __('job.txt_expected_start_date') }}">
                                        <div class="invalid-note"></div>
                                    </div>
                                    <div class="mb-3 col-span-1">
                                        <label for="province_id" class="form-label fw-bold">{{__('job.txt_work_experience')}} <span class="text-danger">*</span></label>
                                        <select name="work_experience" id="work_experience" class="form-select" required>
                                            <option value="">{{ __('cv.exp') }}</option>
                                            <option value="1">{{ __('cv.year_1') }}</option>
                                            <option value="2">{{ __('cv.year_2') }}</option>
                                            <option value="3">{{ __('cv.year_3') }}</option>
                                            <option value="4">{{ __('cv.year_4') }}</option>
                                            <option value="5">{{ __('cv.year_5_plus') }}</option>
                                            <option value="10">{{ __('cv.year_10_plus') }}</option>
                                        </select>
                                        <div class="invalid-note"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer grid grid-cols-5 justify-center items-center gap-2">
                        <x-client.elements.button type="button" class="col-span-4 h-12 flex justify-center items-center gap-2  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200" onclick="applyJob()">
                            {{__('job.txt_apply')}}
                        </x-client.elements.button>
                        <button type="button" class="col-span-1 h-12 btn border border-transparent text-sm font-medium rounded-lg bg-light hover:bg-gray-100  hover:text-primary hover:shadow-xl" data-bs-dismiss="modal">{{__('default.btn_close')}}</button>
                    </div>
                </form>
                @else
                <x-client.login />
                @endif

            </div>
        </div>
    </div>

    <script>
        Fancybox.bind("[data-fancybox='gallery']", {
            // Cấu hình thêm nếu muốn
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#collapseChooseCV').addClass('border-black shadow-md').find('.title-collapse').addClass('font-semibold text-[var(--accent-color)] underline');

            $(document).on('show.bs.collapse', '.collapse', function() {
                var $this = $(this);
                var group = $this.closest('.group-collapse');
                var title = group.find('.title-collapse');

                // Đóng tất cả collapse khác trong cùng group
                $('.collapse').not(this).collapse('hide');
                $('.collapse .title-collapse').removeClass('font-semibold text-[var(--accent-color)] underline');

                // Thêm class active cho khối cha đang mở
                $('.group-collapse').removeClass('border-black shadow-md');
                $this.closest('.group-collapse')
                    .addClass('border-black shadow-md')
                    .find('.title-collapse')
                    .addClass('font-semibold text-[var(--accent-color)] underline')
            });

            // Khi collapse đóng xong → bỏ viền + xoay icon về
            $(document).on('hidden.bs.collapse', '.collapse', function() {
                var $parent = $(this).closest('.group-collapse');
                $parent.removeClass('border-black shadow-md');
                $parent.find('.title-collapse').removeClass('font-semibold text-[var(--accent-color)] underline');
            });

            // Xóa required khi collapse đóng
            $(document).on('hidden.bs.collapse', '#collapseUploadCV', function() {
                $(this).find('input[required]').removeAttr('required');
            });
            // Thêm required khi collapse mở
            $(document).on('show.bs.collapse', '#collapseUploadCV', function() {
                $(this).find('#cv_name, #cv_file').attr('required', 'required');
            });

            $('#applyModal').on('hidden.bs.modal', function() {
                sessionStorage.removeItem('job_apply_url');
                window.location.reload();
            });
        });

        // Lưu URL hiện tại vào sessionStorage
        function saveCurrentUrl() {
            sessionStorage.setItem('job_apply_url', window.location.href);
        }

        // Sau khi login xong sẽ tự động mở
        document.addEventListener('DOMContentLoaded', function() {
            const applyUrl = sessionStorage.getItem('job_apply_url');
            var checkPhone = @json($checkPhone);

            @if(session('applied_successfully'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ __('job.apply_success') }}',
                });
                sessionStorage.removeItem('job_apply_url');
            @else
            if (applyUrl && applyUrl === window.location.href) {
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
            var url = '{{ route("cv.upload") }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
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
                        $('#cv_file_error').text(response.message);
                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('#cv_file_error').text(error);
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

        function applyJob() {
            var form = $("#applyForm");
            if (!form.length) return;
            var formData = new FormData(form[0]);
            $.ajax({
                url: '{{ route("apply.job") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                        $('.invalid-note').empty().removeClass('text-danger');
                        $('#applyModal').modal('hide');
                    } else {
                        Toast.fire({
                                icon: 'error',
                                title: response.message
                            });
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        console.log(errors)
                        $('.invalid-note').empty().removeClass('text-danger');
                        $.each(errors, function(key, message) {

                            let input = $('[name="' + key + '"]');

                            if (input.length > 0) {
                                // Tìm .invalid-note gần nhất (tìm từ div cha gần nhất)
                                let note = input.closest('div')
                                            .find('.invalid-note')
                                            .first();  // lấy cái đầu tiên nếu có nhiều

                                if (note.length) {
                                    note.html(message.join('<br>')).addClass('text-danger');
                                } else {
                                    console.warn('Không tìm thấy .invalid-note cho field:', key);
                                }
                            } else {
                                console.warn('Không tìm thấy input cho field:', key);
                            }
                        });
                        // toastr.error('Vui lòng kiểm tra lại thông tin!');
                    } else {
                        // toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                },
            })
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Tìm tất cả hình ảnh trong phần description
            const descImages = document.querySelectorAll('#description-content img');
            const reqImages = document.querySelectorAll('#requirements-content img');

            descImages.forEach(img => {
                // Tạo thẻ <a> để bọc quanh hình ảnh
                const link = document.createElement('a');
                link.href = img.src; // Lấy link ảnh làm link phóng to
                link.dataset.fancybox = "description-gallery"; // Đặt tên nhóm gallery (tách biệt với gallery chính nếu muốn)

                // Thực hiện bọc thẻ <a> quanh thẻ <img>
                img.parentNode.insertBefore(link, img);
                link.appendChild(img);
            });

            reqImages.forEach(img => {
                // Tạo thẻ <a> để bọc quanh hình ảnh
                const link = document.createElement('a');
                link.href = img.src; // Lấy link ảnh làm link phóng to
                link.dataset.fancybox = "requirements-gallery"; // Đặt tên nhóm gallery (tách biệt với gallery chính nếu muốn)

                // Thực hiện bọc thẻ <a> quanh thẻ <img>
                img.parentNode.insertBefore(link, img);
                link.appendChild(img);
            });

            // Khởi tạo lại Fancybox cho các nhóm mới (nếu cần)
            Fancybox.bind("[data-fancybox='description-gallery']", {});
            Fancybox.bind("[data-fancybox='requirements-gallery']", {});
        });
    </script>
</section>

@endsection