<!DOCTYPE html>
<html class="{{ $theme == 'dark' ? 'dark' : 'light' }}" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Minh Đức Nguyễn - Professional CV</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link href="{{ asset('client/assets/font/inter.css') }}" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#F59E0B", // Orange-500 equivalent
                        "background-light": "#F3F4F6",
                        "background-dark": "#111827",
                        "cv-sidebar-dark": "#374151",
                        "cv-main-dark": "#1F2937",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>

    <style>
        :root::-webkit-scrollbar {
            display: none;
        }

        :root {
            max-height: 100vh;
            overflow-y: scroll;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {


                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .cv-container {
                display: block !important;
                /* Dùng block + float để ngắt trang chuẩn */
                width: 210mm !important;
                min-height: 297mm !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
                background: none !important;
                /* Bỏ gradient, dùng div fixed */
                overflow: visible !important;
                position: relative !important;
                z-index: 0 !important;
            }

            .print-sidebar-bg {
                display: block !important;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 35% !important;
                height: 100% !important;
                background-color: #374151 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                z-index: -1 !important;
            }

            aside {
                float: left !important;
                width: 35% !important;
                background-color: transparent !important;
                /* Nhìn xuyên qua nền cha */
                box-sizing: border-box !important;
                min-height: 297mm !important;
            }

            main {
                float: right !important;
                width: 65% !important;
                background-color: transparent !important;
                /* Nhìn xuyên qua nền cha */
                box-sizing: border-box !important;
                min-height: 297mm !important;
            }

            /* Ngắt trang thông minh */
            section {
                display: block !important;
                width: 100% !important;
                clear: both;
            }

            /* Ngăn các khối nội dung quan trọng bị cắt đôi khi sang trang */
            .experience,
            .project,
            .flex.flex-col.gap-2 {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* Đảm bảo tiêu đề section không nằm cuối trang một mình */
            h2 {
                page-break-after: avoid !important;
                break-after: avoid !important;
            }

            .cv-container::after {
                content: "";
                display: table;
                clear: both;
            }

            /* Chỉnh lại ảnh đại diện khi in */
            img {
                -webkit-print-color-adjust: exact;
            }

            .cv-name {
                font-size: 14pt !important;
                line-height: 1.2 !important;
                white-space: nowrap !important;
                display: block !important;
                width: 100% !important;
                letter-spacing: -0.02em !important;
            }

            .cv-title {
                font-size: 14pt !important;
                margin-top: 5px !important;
            }
        }

        /* Hiển thị trên màn hình (giữ nguyên để xem trên web) */
        body {
            font-family: 'Inter', sans-serif;
        }

        .cv-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        .print-sidebar-bg {
            display: none;
        }
    </style>

</head>

<body class=" bg-background-light dark:bg-background-dark min-h-screen transition-colors duration-200 !mb-0">

    <div class="bg-white dark:bg-cv-main-dark shadow-2xl flex flex-col md:flex-row cv-container ">
        <!-- Element này tạo nền cho sidebar khi in (hiển thị ở mọi trang) -->
        <div class="print-sidebar-bg"></div>

        <aside class=" w-full md:w-[35%] bg-cv-sidebar-dark text-white p-6 pb-0 flex flex-col gap-8">
            <div class="relative mx-auto bg-gray-400 dark:bg-gray-600 overflow-hidden">
                <img alt="Profile Picture" class="w-[200px] h-[200px] object-cover " src="{{ !empty($profile->avatar) ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" />
            </div>
            <div class="text-center ">
                <h1 class="cv-name text-lg md:text-3xl font-bold text-primary mb-2 uppercase tracking-tight">{{$profile->full_name ?? __('cv.user_name_default')}}</h1>
                <p class="cv-title text-lg font-medium text-gray-300">{{$profile->title ?? __('cv.title_default')}}</p>
            </div>
            <section>
                <div class="flex items-center gap-2 mb-4">
                    <h2 class="text-primary font-bold uppercase tracking-wider">{{ __('cv.contact_info') }}</h2>
                    <div class="flex-grow h-px bg-primary/30"></div>
                </div>
                <ul class="space-y-2 text-xs font-light text-gray-300">
                    <li class="flex items-center gap-3">
                        <span class="material-icons-round text-primary text-lg">phone</span>
                        <span>{{ $profile->phone_number ?? __('cv.phone_default') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons-round text-primary text-lg">email</span>
                        <span class="break-all">{{ $user->email ?? __('cv.email_default') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons-round text-primary text-lg">location_on</span>
                        <span>{{ !empty($profile->province_name) ? (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) : __('cv.address_default') }}</span>
                    </li>
                </ul>
            </section>
            <section>
                <div class="flex items-center gap-2 mb-4">
                    <h2 class="text-primary font-bold uppercase tracking-wider">{{ __('cv.skills') }}</h2>
                    <div class="flex-grow h-px bg-primary/30"></div>
                </div>
                <div class="space-y-3">
                    @php
                    $groupedSkills = !empty($profile->skills) ? collect($profile->skills)->groupBy('group') : collect();
                    $softSkills = (!empty($groupedSkills) && $groupedSkills->get('Soft Skill')) ? $groupedSkills->get('Soft Skill')  : collect();
                    $coreGroups = $groupedSkills->except(['Soft Skill']);
                    @endphp
                    @if(!empty($coreGroups))
                    @foreach($coreGroups as $groupName => $groupSkills)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h6 fw-bold text-uppercase text-muted letter-spacing-1 underline pb-2">{{$groupName}}</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3"> <!-- gap-x rộng hơn để tách biệt các cụm -->
                            @if(!empty($groupSkills))
                            @foreach($groupSkills as $skill)
                            <span class="border-2 border-gray-100 p-1 rounded-md fw-normal whitespace-nowrap text-xs"> <!-- Thêm whitespace-nowrap -->
                                {{ $skill->name }}
                                @if($skill->year_of_experience)
                                <small class="fw-bold">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</small>
                                @endif
                            </span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </section>
        </aside>
        <main class="w-full md:w-[65%] p-6 pb-0 bg-white dark:bg-cv-main-dark text-gray-800 dark:text-gray-200">

            <!-- SUMMARY -->
            <section class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.summary') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                <p class="text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                    {!! $profile->summary ?? __('cv.summary_default') !!}
                </p>
            </section>

            <!-- EXPERIENCE -->
            <section class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.work_experience') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                @if(empty($profile->experiences) || $profile->experiences->isEmpty())
                <p class="text-muted fst-italic">{{ __('cv.no_experience') }}</p>
                @else
                @foreach($profile->experiences as $exp)
                <div class="mb-8 experience">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2">
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase">{{ $exp->position }}</h3>
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">{{$exp->start_date->format('Y-m')}} — {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('cv.present') }}</span>
                    </div>
                    <p class="font-bold text-primary text-xs mb-3">{{ $exp->company_name }}</p>
                    <div class="text-muted dark:text-gray-400 whitespace-pre-line text-xs">{!! $exp->description ? trim($exp->description) : '' !!}</div>
                </div>
                @endforeach
                @endif
            </section>

            <!-- EDUCATION -->
            <section class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.education') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                @if(empty($profile->educations) || $profile->educations->isEmpty())
                <p class="text-muted fst-italic">{{ __('cv.no_education') }}</p>
                @else
                @foreach($profile->educations as $edu)
                <div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-1">
                        @if(!empty($edu->description))
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase text-xs">{!! $edu->description !!}</h3>
                        @endif
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">{{ $edu->start_date->format('Y-m') }} — {{ $edu->end_date ? $edu->end_date->format('Y-m') : 'Present' }}</span>
                    </div>
                    <p class="font-bold text-primary text-xs mb-2">{{$edu->school}}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 italic">{{$edu->degree ?? ''}} {{ $edu->major ? ': ' . $edu->major : '' }}</p>
                </div>
                @endforeach
                @endif
            </section>

            <!-- PROJECT -->
            <section>
                <div class="flex items-center gap-4 mb-4">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.projects') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                <div>
                    @if(empty($profile->projects) || $profile->projects->isEmpty())
                    <p class="text-muted fst-italic">{{ __('cv.no_projects') }}</p>
                    @else
                    <div class="flex flex-col gap-2 mb-0">
                        @foreach($profile->projects as $project)
                        <div class="flex flex-col gap-2 mb-4 project">
                            <p class="font-bold text-gray-900 dark:text-white uppercase">{{ $project->name }}</p>
                            <p class="dark:text-gray-400 text-xs">{!! $project->description ?? '' !!}</p>
                            @if(!empty($project->url))
                            <a href="{{ $project->url }}" target="_blank" class="text-primary small text-xs text-decoration-none fw-medium">
                                {{ $project->url }} <i class="ti ti-external-link ms-1"></i>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

</body>

</html>