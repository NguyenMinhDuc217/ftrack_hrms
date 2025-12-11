@extends('layouts.client')

@section('title', __('cv.profile'))

@section('content')

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 flex flex-col gap-3 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer">
                <h1 class="text-lg font-bold mb-4">{{ $job->title }}</h1>
                <div class="flex flex-3">
                    <div class="flex-1 flex items-center gap-2">
                        <div class="w-14 h-14 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                            <i class="bi bi-coin text-white text-4xl"></i>
                        </div>
                        <div>
                            <p>Thu nhập</p>
                            <p>{{ number_format($job->min_salary / 1000000, 1) }} - {{ number_format($job->max_salary / 1000000, 1) }} triệu</p>
                        </div>
                    </div>
                    <div class="flex-1 flex items-center gap-2">
                        <div class="w-12 h-12 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                            <i class="bi bi-geo-alt-fill text-white text-3xl"></i>
                        </div>
                        <div>
                            <p>Địa điểm</p>
                            <p>Hà nội</p>
                        </div>
                    </div>
                     <div class="flex-1 flex items-center gap-2">
                        <div class="w-12 h-12 flex justify-center items-center gap-2 rounded-full border border-gray-200 p-2 bg-[var(--accent-color)]">
                            <i class="bi bi-hourglass text-white text-3xl"></i>
                        </div>
                        <div>
                            <p>Kinh nghiệm</p>
                            <p>{{ $job->experience }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    Hạn nộp hồ sơ: 
                    <span class="font-semibold">{{ $job->end_date }} ({{  number_format(Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays($job->end_date)) }} ngày)</span>
                </div>
                <button class="btn bg-[var(--accent-color)] text-white w-full flex justify-center items-center gap-2 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200"><i class="bi bi-send-plus"></i><span>Ứng tuyển ngay</span></button>
            </div>

            <div class="col-span-1 grid grid-cols-3 gap-4 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer">
                <div class="col-span-1 flex flex-col gap-2">
                    <div>
                        <img src="{{ asset('client/assets/img/avatar.png') }}" alt="">
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="flex flex-col gap-2">
                        <p>CPM VIETNAME</p>
                        <p>60 Nguyễn Đình Chiểu</p>
                    </div>
                </div>
            </div>

            <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer">
                <h1 class="text-lg font-bold mb-4">Mô tả công việc</h1>
                <p>{{ $job->description_md }}</p>
            </div>
            <div class="col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer">
                <button class="btn btn-primary">Back</button>
            </div>
             <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer">
                <h1 class="text-lg font-bold mb-4">Yêu cầu</h1>
                <p>{{ $job->requirements_md }}</p>
            </div>
            <div class="col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer">
                <button class="btn btn-primary">Back</button>
            </div>
        </div>

    </div>
</section>

@endsection