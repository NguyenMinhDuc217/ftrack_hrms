<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Nguyễn Hoàng Anh - CV</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#F59E0B", // Orange
                        secondary: "#1E40AF", // Blue
                        "background-light": "#F0F9F4", // Pale mint/pastel green
                        "background-dark": "#0F172A",
                        "card-green": "#E2F3EB",
                        "card-yellow": "#FEF9C3",
                        "text-main": "#374151",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 24px;
            bottom: -24px;
            width: 2px;
            background-color: #FEF3C7;
        }

        .timeline-item:last-child::before {
            display: none;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen ">
    <div class="w-full bg-white dark:bg-slate-900 shadow-xl rounded-2xl overflow-hidden">
        <div class="p-8 pb-0">
            <div class="bg-card-green dark:bg-slate-800 rounded-[2rem] p-8 flex flex-col md:flex-row items-center gap-8">
                <div class="relative w-40 h-40 flex-shrink-0">
                    <img alt="Nguyễn Hoàng Anh Profile" class="w-full h-full object-cover rounded-full border-4 border-white dark:border-slate-700 shadow-md" src="{{ $profile->avatar ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" />
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-primary uppercase tracking-tight">{{$profile->full_name ?? __('cv.user_name_default')}}</h1>
                    <p class="text-xl text-secondary dark:text-blue-400 font-semibold mt-2">{{$profile->title ?? __('cv.title_default')}}</p>
                </div>
            </div>
        </div>
        <div class="p-8 grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="md:col-span-4 space-y-6">

                <!-- Thông tin cá nhân -->
                <div class="bg-card-green dark:bg-slate-800 p-5 rounded-2xl relative">
                    <div class="bg-gradient-to-r from-orange-400 to-orange-300 dark:bg-yellow-900/30 px-4 py-1.5 rounded-full inline-block mb-6 absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <h3 class="text-white dark:text-yellow-200 font-bold text-sm">{{ __('cv.contact_info') }}</h3>
                    </div>

                    <ul class="space-y-4 text-sm text-gray-700 dark:text-slate-300">
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center">
                                calendar_today
                            </span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') ?? 'N/A' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center">
                                phone
                            </span>
                            <span class="font-medium">{{ $profile->phone_number ?? __('cv.phone_default') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center">
                                email
                            </span>
                            <span class="font-medium">{{ $user->email ?? __('cv.email_default') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center">
                                home
                            </span>
                            <span class="font-medium">{{ !empty($profile->province_name) ? (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) : __('cv.address_default') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Summary -->
                <div class="bg-card-green dark:bg-slate-800 p-5 rounded-2xl relative">
                    <div class="bg-gradient-to-r from-orange-400 to-orange-300 dark:bg-yellow-900/30 px-4 py-1.5 rounded-full inline-block mb-6 absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <h3 class="text-white dark:text-yellow-200 font-bold text-sm">{{ __('cv.summary') }}</h3>
                    </div>
                    <p class="text-sm leading-relaxed text-text-main dark:text-slate-300">
                        {{ $profile->summary ?? __('cv.summary_default') }}
                    </p>
                </div>

                <!-- Skills -->
                <div class="bg-card-green dark:bg-slate-800 p-5 rounded-2xl relative">
                    <div class="bg-gradient-to-r from-orange-400 to-orange-300 dark:bg-yellow-900/30 px-4 py-1.5 rounded-full inline-block mb-6 absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <h3 class="text-white dark:text-yellow-200 font-bold text-sm">{{ __('cv.skills') }}</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-text-main dark:text-slate-300">
                         @php
                        $groupedSkills = collect($profile->skills)->groupBy('group');
                        $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
                        $coreGroups = $groupedSkills->except(['Soft Skill']);
                        @endphp
                        @foreach($coreGroups as $groupName => $groupSkills)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                            {{ $groupName }}
                        </li>
                        <ul class="list-disc">
                            @foreach($groupSkills as $skill)
                                <li class="fw-normal whitespace-nowrap text-sm">
                                    <span class="text-wrap">{{ $skill->name }} 2332r32222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222</span> 
                                    @if($skill->year_of_experience)
                                    <small class="fw-bold">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</small>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @endforeach
                       
                    </ul>
                </div>

            </div>
            <div class="md:col-span-8 space-y-8">
                <section>
                    <div class="bg-card-green dark:bg-emerald-900/20 rounded-lg px-4 py-2 mb-6">
                        <h3 class="text-primary font-bold text-lg uppercase">Học vấn</h3>
                    </div>
                    <div class="space-y-6 relative">
                        <div class="timeline-item relative pl-10">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-secondary rounded-full flex items-center justify-center text-white z-10">
                                <span class="material-icons text-xs">school</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-between mb-1">
                                <h4 class="font-bold text-primary">Trường Đại học TopCV</h4>
                                <span class="text-primary text-sm font-semibold">10/2017 - 06/2021</span>
                            </div>
                            <p class="font-bold text-secondary dark:text-blue-400 mb-2">Ngành Kinh doanh quốc tế</p>
                            <ul class="list-disc list-inside space-y-1 text-sm text-text-main dark:text-slate-300 ml-2">
                                <li>Xếp loại: Xuất sắc</li>
                                <li>Giải thưởng:
                                    <ul class="list-none ml-6 mt-1 space-y-1">
                                        <li>• Top 10 sinh viên tiêu biểu năm học 2018 - 2019</li>
                                        <li>• Top 10 sinh viên thành tích học tập xuất sắc toàn khóa</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="bg-card-green dark:bg-emerald-900/20 rounded-lg px-4 py-2 mb-6">
                        <h3 class="text-primary font-bold text-lg uppercase">Kinh nghiệm làm việc</h3>
                    </div>
                    <div class="space-y-10 relative">
                        <div class="timeline-item relative pl-10">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-secondary rounded-full flex items-center justify-center text-white z-10">
                                <span class="material-icons text-xs">business_center</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-between mb-1">
                                <h4 class="font-bold text-primary">Chuyên viên quan hệ khách hàng cá nhân</h4>
                                <span class="text-primary text-sm font-semibold">01/2024 - Nay</span>
                            </div>
                            <p class="font-bold text-secondary dark:text-blue-400 mb-3">MW Group, Inc.</p>
                            <ul class="list-disc list-inside space-y-2 text-sm text-text-main dark:text-slate-300 ml-2">
                                <li>Quản lý danh mục hơn 200 khách hàng cá nhân, đảm bảo tỷ lệ duy trì khách hàng đạt 95%.</li>
                                <li>Phân tích hồ sơ tín dụng, đề xuất các gói vay phù hợp, góp phần tăng 30% dư nợ tín dụng trong 02 năm liên tiếp.</li>
                                <li>Hỗ trợ khách hàng xây dựng chiến lược tài chính cá nhân, tư vấn các gói tiết kiệm và đầu tư với tỷ lệ chốt giao dịch thành công trên 85%.</li>
                                <li>Phối hợp với bộ phận kiểm soát tín dụng để đảm bảo quy trình phê duyệt khoản vay đạt chuẩn và tuân thủ các quy định của ngân hàng.</li>
                                <li class="list-none pt-2">
                                    <span class="font-bold text-text-main dark:text-slate-200">Thành tựu:</span>
                                    <ul class="list-none ml-4 mt-1">
                                        <li>• Đạt 168% KPI doanh số tín dụng</li>
                                        <li>• Đạt 145% chỉ tiêu bảo hiểm trong năm 2024.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="timeline-item relative pl-10">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-secondary rounded-full flex items-center justify-center text-white z-10">
                                <span class="material-icons text-xs">business_center</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-between mb-1">
                                <h4 class="font-bold text-primary">Chuyên viên quan hệ khách hàng cá nhân</h4>
                                <span class="text-primary text-sm font-semibold">04/2021 - 12/2023</span>
                            </div>
                            <p class="font-bold text-secondary dark:text-blue-400 mb-3">SVT Financial Group, Inc.</p>
                            <ul class="list-disc list-inside space-y-2 text-sm text-text-main dark:text-slate-300 ml-2">
                                <li>Quản lý danh mục 150+ khách hàng cá nhân, tư vấn và cung cấp các sản phẩm tín dụng, tiết kiệm và bảo hiểm.</li>
                                <li>Hỗ trợ khách hàng trong quá trình vay vốn, thẩm định hồ sơ tín dụng.</li>
                                <li>Phối hợp với bộ phận chăm sóc khách hàng để nâng cao trải nghiệm người dùng.</li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="p-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-colors" onclick="document.documentElement.classList.toggle('dark')">
                <span class="material-icons">dark_mode</span>
            </button>
        </div>
    </div>

</body>

</html>