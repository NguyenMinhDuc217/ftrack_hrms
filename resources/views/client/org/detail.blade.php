@extends('layouts.client')

@section('title', $org->name ?? 'Organization')

@section('content')

<section class="py-6 bg-gray-50">

    <style>
        #description-content a[data-fancybox] {
            display: inline-block !important;
            vertical-align: middle;
            margin-right: 8px;
            margin-bottom: 8px;
            max-width: 100%;
        }

        #description-content img {
            display: block !important;
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            cursor: zoom-in;
        }

        #description-content p:has(img) {
            display: block; 
        }
    </style>

    @php
        $locale = app()->getLocale();
    @endphp
    <div class="container mx-auto px-4 flex flex-col gap-4">

        <div class="bg-white rounded-0 shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
            <div class="flex items-stretch gap-4">
                <img src="{{ $org->image->url ?? asset('images/profile/blank-profile.svg') }}" 
                        alt="Logo công ty" 
                        class="w-[8rem] h-[8rem] rounded-0 object-contain border border-gray-200 shadow-sm flex-shrink-0" />

                <div class="flex-1 min-w-0 flex flex-col justify-between">
                    <div class="flex flex-col gap-1">
                    <a href="{{ route('client.org.detail', $org) }}">
                        <h3 class="text-xl font-bold text-gray-900 alumni-font">{{ $org->name ?? 'N/A' }}</h3>
                    </a>
                    </div>
                    <div class="text-sm text-gray-600 mt-1 rounded-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-5">
                            <div class="flex items-center gap-2 p-2 rounded-2xl border !border-gray-200 shadow-sm">
                                <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--blue-color)] flex-shrink-0">
                                    <i class="bi bi-people text-white text-4xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('job.txt_scale') }}</p>
                                    <p class="font-semibold text-gray-900">
                                    {{ $org->workforce_size . ' ' . __('job.txt_employees') ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 p-2 rounded-2xl border !border-gray-200 shadow-sm">
                                <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)] flex-shrink-0">
                                    <i class="bi bi-briefcase text-white text-3xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{__('job.txt_business_field')}}</p>
                                    <p class="font-semibold text-gray-900">{{ $org->business_field ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 p-2 rounded-2xl border !border-gray-200 shadow-sm">
                                <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--red-color)] flex-shrink-0">
                                    <i class="ti ti-briefcase text-white text-3xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('org.txt_active_jobs') }}</p>
                                    <p class="font-semibold text-gray-900">{{ $org->jobs->count() }} {{ __('org.txt_openings') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-8">
            <!-- LEFT -->
            <div class="lg:col-span-8 ">
                <!-- About Us -->
                <div class="flex flex-col gap-4 bg-white rounded-0 shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
                    <div>
                        <div class="flex items-center gap-2 pl-2 border-l-4 border-[var(--blue-color)]">
                            <i class="bi bi-buildings text-[var(--blue-color)] text-2xl"></i>
                            <h2 class="text-lg font-bold text-gray-900 alumni-font">{{ Str::upper(__('default.txt_about_us')) }}</h2>
                        </div>
                        <div id="description-content" class="mt-2 prose prose-sm max-w-none text-gray-700 whitespace-pre-line">
                            {!! $org->description !!}
                        </div>
                    </div>
                </div>

                <!-- Job Openings -->
                <div class="py-4 space-y-4">
                    <div class="flex items-center justify-between px-4 !pr-0">
                        <div class="flex items-center gap-2 pl-2 border-l-4 border-[var(--red-color)]">
                            <i class="ti ti-briefcase text-[var(--red-color)] text-2xl"></i>
                            <h2 class="text-lg font-bold text-gray-900 alumni-font">{{ Str::upper(__('org.txt_job_openings')) }}</h2>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $org->jobs->count() > 0 ? $org->jobs->count() . ' ' . __('org.txt_active_jobs') : '' }}</span>
                    </div>
                    <div class="flex flex-col gap-2" id="job-container">
                        @foreach ($org->jobs as $index => $job)
                        <div class="job-item p-4 bg-white rounded-0 shadow-sm border border-gray-100 hover:shadow-xl transition-shadow justify-between items-center grid grid-cols-1 md:grid-cols-5 gap-4 {{ $index >= 2 ? 'hidden' : '' }}">
                            <div class="flex flex-col gap-2 md:col-span-4">
                                <div class="flex gap-2">
                                        
                                        <span class="px-2 py-1 rounded-md text-xs bg-lime-100 flex items-center gap-1"><i class="bi bi-alarm"></i> {{ Str::upper($job->employment_type) }}</span>
                                    @if($job->job_area->count() > 0)
                                        <span class="px-2 py-1 bg-gray-100 rounded-md text-xs">
                                            <i class="bi bi-geo-alt-fill text-[var(--blue-color)]"></i>
                                            {{ $job->job_area->first()->province->localized_name ?? '' }} {{ $job->job_area->count() > 1 ? ' ' . __('job.txt_and') . ' ' . ($job->job_area->count() - 1) . ' ' . __('job.txt_otherwhere') : '' }}
                                        </span>
                                    @endif
                                    
                                </div>
                                
                                <h3 class="text-truncate font-bold">{{ $job->name }}</h3>
    
                                <div class="flex flex-col sm:flex-row sm:gap-4">
                                    <div class="text-sm flex items-center gap-2">
                                        <div class="flex justify-center items-center w-6 h-6 bg-gray-100 rounded-circle">
                                            <i class="bi bi-coin text-[var(--blue-color)]"></i>
                                        </div>
                                        <span>
                                            {{ __('job.txt_salary_rank', ['min' => number_format($job->min_salary / 1000000, 1), 'max' => number_format($job->max_salary / 1000000, 1)]) }}
                                        </span>
                                    </div>
    
                                    <div class="text-sm flex items-center gap-2">
                                        <div class="flex justify-center items-center w-6 h-6 bg-gray-100 rounded-circle">
                                            <i class="bi bi-hourglass text-[var(--accent-color)]"></i>
                                        </div>
                                        <span>
                                            {{ $job->experience ? trim(str_replace(['năm', 'year', 'years', 'Năm', 'Year', 'Years'], '', $job->experience)) . ' '. __('job.txt_year')  : __('job.txt_no_experience') }} {{ Str::lower(__('job.txt_experience')) }}
                                        </span>
                                    </div>
    
                                    <div class="text-sm flex items-center gap-2">
                                        <div class="flex justify-center items-center w-6 h-6 bg-gray-100 rounded-circle">
                                            <i class="bi bi-people text-[var(--red-color)]"></i>
                                        </div>
                                        <span>
                                            {{ $job->job_area->first()->headcount }} {{ __('org.txt_people') }}
                                        </span>
                                    </div>
    
                                </div>
    
                            </div>
                            
                            <x-client.elements.button type="button" class="h-10 flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" data-bs-toggle="modal" data-bs-target="#applyModal" onclick="window.location.href = '{{ route('client.job.detail', $job->slug) }}'">
                                <span>{{ __('job.txt_detail') }}</span>
                            </x-client.elements.button>
                            
                        </div>
                        @endforeach
                    </div>

                    @if($org->jobs->count() > 2)
                        <div class="text-center mt-3 flex justify-center">
             
                            <x-client.elements.button type="button" class="h-12 flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" id="toggle-jobs-btn" data-state="collapsed">
                                <span id="btn-text">
                                    {{ __('org.txt_load_more_jobs', ['number' => $org->jobs->count() - 2 > 2 ? 2 : $org->jobs->count() - 2]) }}</span> 
                                <i id="btn-icon" class="bi bi-chevron-down"></i>
                            </x-client.elements.button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT -->
            <div class="lg:col-span-4 flex flex-col gap-4">
                <div class="bg-white rounded-0 shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2 pl-2 border-l-4 border-[var(--accent-color)] ">
                            <i class="bi bi-info-circle text-[var(--accent-color)] text-2xl"></i>
                            <h2 class="text-lg font-bold text-gray-900 alumni-font">{{ Str::upper(__('default.txt_contact')) }}</h2>
                        </div>
                        <div class="text-sm flex items-center gap-2">
                             <div class="flex justify-center items-center w-10 h-10 bg-gray-100 rounded-full flex-shrink-0 border border-gray-200">
                                <i class="bi bi-geo-alt text-gray-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('org.txt_address') }}</p>
                                <p class="font-semibold text-sm">{{ $org->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="text-sm flex items-center gap-2">
                             <div class="flex justify-center items-center w-10 h-10 bg-gray-100 rounded-full flex-shrink-0 border border-gray-200">
                                <i class="bi bi-envelope text-gray-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('org.txt_email') }}</p>
                                <p class="font-semibold text-sm">{{ $org->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="text-sm flex items-center gap-2">
                             <div class="flex justify-center items-center w-10 h-10 bg-gray-100 rounded-full flex-shrink-0 border border-gray-200">
                                <i class="bi bi-telephone text-gray-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('org.txt_phone_number') }}</p>
                                <p class="font-semibold text-sm">{{ $org->phone_number ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="text-sm flex items-center gap-2">
                             <div class="flex justify-center items-center w-10 h-10 bg-gray-100 rounded-full flex-shrink-0 border border-gray-200">
                                <i class="ti ti-world text-gray-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('org.txt_official_website') }}</p>
                                <a href="{{ $org->link ?? '' }}" class="font-semibold text-sm text-[var(--blue-color)] underline">{{ $org->link ? parse_url($org->link, PHP_URL_HOST) : 'N/A' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-0 shadow-sm border border-gray-100 p-4 hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-2 pl-2 border-l-4 border-[var(--accent-color)] ">
                        <i class="bi bi-info-circle text-[var(--accent-color)] text-2xl"></i>
                        <h2 class="text-lg font-bold text-gray-900 alumni-font">{{ Str::upper('Location') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</section>



<script>
    $(document).ready(function() {
        const step = 2;
        $('#toggle-jobs-btn').on('click', function() {
            const $btn = $(this);
            const state = $btn.attr('data-state'); // Lấy trạng thái hiện tại
            const $container = $('#job-container');
            const $allItems = $container.find('.job-item');
            const totalMore = $allItems.length;
            let transLoadMore = '{{ __('org.txt_load_more_jobs', ['number' => ':number']) }}';
            let transCollapse = '{{ __('org.txt_collapse') }}';

            if (state === 'collapsed') {
                // TRẠNG THÁI ĐANG THU GỌN -> MỞ RA
                const $hiddenItems = $container.find('.job-item.hidden');
                $hiddenItems.slice(0, step).removeClass('hidden').hide().fadeIn(400)

                const currentVisible = $container.find('.job-item:not(.hidden)').length;
                const remaining = totalMore - currentVisible;

                if (remaining > 0) {
                    const nextLoad = remaining > step ? step : remaining;
                    $('#btn-text').text(transLoadMore.replace(':number', nextLoad));
                } else {
                    $btn.attr('data-state', 'expanded');
                    $('#btn-text').text(transCollapse);
                    $('#btn-icon').removeClass('bi-chevron-down').addClass('bi-chevron-up');
                }

            } else {
                // XỬ LÝ THU GỌN (Quay về 2 cái đầu tiên)
                $allItems.slice(step).addClass('hidden');
                $btn.attr('data-state', 'collapsed');
                
                // Tính toán lại text cho nút sau khi thu gọn
                const remainingAfterCollapse = totalMore - step;
                const nextLoadCount = remainingAfterCollapse > step ? step : remainingAfterCollapse;
                
                $('#btn-text').text(transLoadMore.replace(':number', nextLoadCount));
                $('#btn-icon').removeClass('bi-chevron-up').addClass('bi-chevron-down');

                // Cuộn trang lên đầu danh sách job
                $('html, body').animate({
                    scrollTop: $container.offset().top - 150
                }, 500);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Tìm tất cả hình ảnh trong phần description
        const descImages = document.querySelectorAll('#description-content img');
        
        descImages.forEach(img => {
            // Tạo thẻ <a> để bọc quanh hình ảnh
            const link = document.createElement('a');
            link.href = img.src; // Lấy link ảnh làm link phóng to
            link.dataset.fancybox = "description-gallery"; // Đặt tên nhóm gallery (tách biệt với gallery chính nếu muốn)

            // Thực hiện bọc thẻ <a> quanh thẻ <img>
            img.parentNode.insertBefore(link, img);
            link.appendChild(img);
        });

        // Khởi tạo lại Fancybox cho các nhóm mới (nếu cần)
        Fancybox.bind("[data-fancybox='description-gallery']", {});
    });
</script>

@endsection