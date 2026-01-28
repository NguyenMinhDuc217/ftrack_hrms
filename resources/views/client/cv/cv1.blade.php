<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Minh Đức Nguyễn - Professional CV</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
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
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            html {
                /* Giúp trình duyệt tính toán đúng chiều cao của body */
                height: auto !important;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .cv-container {
                display: flex !important;
                flex-direction: row !important;
                width: 210mm !important;
                /* Bỏ min-height cố định để nội dung chảy tự nhiên */
                min-height: 100% !important;
                background: transparent !important;
                /* Làm trong suốt để thấy nền của body */
                box-shadow: none !important;
                margin: 0 !important;
            }

            aside {
                width: 35% !important;
                background: transparent !important;
                /* Trong suốt */
                color: white !important;
                padding: 10mm 5mm !important;
                flex-shrink: 0 !important;
            }

            main {
                width: 65% !important;
                background: transparent !important;
                /* Trong suốt */
                padding: 10mm !important;
                flex-grow: 1 !important;
                color: #1F2937 !important;
                /* Ép màu chữ tối để dễ đọc khi in */
            }

            /* Ngăn chặn các khoảng trống do ngắt trang không hợp lý */
            section {
                page-break-inside: auto !important;
                margin-bottom: 5mm !important;
                display: block !important;
            }

            /* Giữ tiêu đề đi kèm với nội dung phía dưới */
            h2,
            h3 {
                page-break-after: avoid !important;
            }

            /* Ẩn các icon nếu cần để bản in sạch hơn */
            .material-icons-round {
                line-height: 1 !important;
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
    </style>

</head>

<body class=" bg-background-light dark:bg-background-dark min-h-screen transition-colors duration-200 !mb-0">

    <div class="bg-white dark:bg-cv-main-dark shadow-2xl flex flex-col md:flex-row cv-container ">
        <aside class="w-full md:w-[35%] bg-cv-sidebar-dark text-white p-8 flex flex-col gap-8">
            <div class="relative  mx-auto mb-4 bg-gray-400 dark:bg-gray-600 overflow-hidden">
                <img alt="Profile Picture" class="w-[200px] h-[200px] object-cover " src="{{ $profile->avatar ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" />
            </div>
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold text-primary mb-2 uppercase tracking-tight">{{$profile->full_name ?? __('cv.user_name_default')}}</h1>
                <p class="text-lg font-medium text-gray-300">{{$profile->title ?? __('cv.title_default')}}</p>
            </div>
            <section>
                <div class="flex items-center gap-2 mb-4">
                    <h2 class="text-primary font-bold uppercase tracking-wider">{{ __('cv.contact_info') }}</h2>
                    <div class="flex-grow h-px bg-primary/30"></div>
                </div>
                <ul class="space-y-4 text-sm font-light text-gray-300">
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
                    $groupedSkills = collect($profile->skills)->groupBy('group');
                    $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
                    $coreGroups = $groupedSkills->except(['Soft Skill']);
                    @endphp
                    @foreach($coreGroups as $groupName => $groupSkills)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h6 fw-bold text-uppercase text-muted letter-spacing-1 underline pb-2">{{$groupName}}</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3"> <!-- gap-x rộng hơn để tách biệt các cụm -->
                            @foreach($groupSkills as $skill)
                            <span class="border-2 border-gray-100 p-1 rounded-md fw-normal whitespace-nowrap text-sm"> <!-- Thêm whitespace-nowrap -->
                                {{ $skill->name }}
                                @if($skill->year_of_experience)
                                <small class="fw-bold">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</small>
                                @endif
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </section>
        </aside>
        <main class="w-full md:w-[65%] p-10 bg-white dark:bg-cv-main-dark text-gray-800 dark:text-gray-200">

            <!-- SUMMARY -->
            <section class="mb-10">
                <div class="flex items-center gap-4 mb-4">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.summary') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                    {{ $profile->summary ?? __('cv.summary_default') }}
                </p>
            </section>

            <!-- EXPERIENCE -->
            <section class="mb-10">
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.work_experience') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                @if($profile->experiences->isEmpty())
                <p class="text-muted fst-italic">{{ __('cv.no_experience') }}</p>
                @else
                @foreach($profile->experiences as $exp)
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2">
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase">{{ $exp->position }}</h3>
                        <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">{{$exp->start_date->format('Y-m')}} — {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('cv.present') }}</span>
                    </div>
                    <p class="font-bold text-primary text-sm mb-3">{{ $exp->company_name }}</p>
                    <div class="text-muted dark:text-gray-400 whitespace-pre-line">{{ $exp->description ? trim($exp->description) : '' }}</div>
                </div>
                @endforeach
                @endif
            </section>

            <section class="mb-10">
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.education') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                @if($profile->educations->isEmpty())
                <p class="text-muted fst-italic">{{ __('cv.no_education') }}</p>
                @else
                @foreach($profile->educations as $edu)
                <div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-1">
                        @if(!empty($edu->description))
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase">{{$edu->description}}</h3>
                        @endif
                        <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">{{ $edu->start_date->format('Y-m') }} — {{ $edu->end_date ? $edu->end_date->format('Y-m') : 'Present' }}</span>
                    </div>
                    <p class="font-bold text-primary text-sm mb-2">{{$edu->school}}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 italic">{{$edu->degree ?? ''}} {{ $edu->major ? ': ' . $edu->major : '' }}</p>
                </div>
                @endforeach
                @endif
            </section>
            <section>
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="text-xl font-bold text-primary uppercase whitespace-nowrap">{{ __('cv.projects') }}</h2>
                    <div class="flex-grow h-px bg-primary/20"></div>
                </div>
                <div>
                    @if($profile->projects->isEmpty())
                    <p class="text-muted fst-italic">{{ __('cv.no_projects') }}</p>
                    @else
                    <div class="flex flex-col gap-2 mb-8">
                        @foreach($profile->projects as $project)
                        <div class="flex flex-col gap-2 mb-4">
                            <p class="font-bold text-gray-900 dark:text-white uppercase">{{ $project->name }}</p>
                            <p class="dark:text-gray-400">{{ $project->description ?? '' }}</p>
                            @if(!empty($project->url))
                            <a href="{{ $project->url }}" target="_blank" class="text-primary small text-decoration-none fw-medium">
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