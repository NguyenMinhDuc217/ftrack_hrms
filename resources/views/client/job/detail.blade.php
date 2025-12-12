@extends('layouts.client')

@section('title', __('cv.profile'))

@section('content')

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
                                <p class="font-semibold text-gray-900">{{ $job->area_application->first()->province->name ?? '' }} {{ $job->area_application->count() > 1 ? 'và ' . ($job->area_application->count() - 1) . ' nơi khác' : '' }}</p>
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
                    <button class="h-12 btn bg-[var(--accent-color)] text-white w-full flex justify-center items-center gap-2 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200"><i class="bi bi-send-plus"></i><span>Ứng tuyển ngay</span></button>
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

                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-gray-900">Khu vực tuyển dụng</h3>
                         @if($job->area_application->count() > 0)
                        <div class="flex flex-wrap items-center gap-1 text-sm text-gray-600 my-2">
                            <i class="text-xl bi bi-geo-alt-fill text-[var(--accent-color)]"></i>
                            @foreach($job->area_application as $area)
                                <span class="p-2 bg-gray-100 rounded-md text-xs">
                                    {{ $area->province->name ?? '' }}
                                </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
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

    </div>
</section>

@endsection