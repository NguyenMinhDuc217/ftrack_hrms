<!DOCTYPE html>
<html class="{{ $theme == 'dark' ? 'dark' : 'light' }}" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CV3</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="{{ asset('client/assets/font/inter.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3a8a",
                        "background-light": "#ffffff",
                        "background-dark": "#0f172a",
                        "section-bg-light": "#f3f4f6",
                        "section-bg-dark": "#1e293b",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
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
                width: 210mm !important;
                min-height: 297mm !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
                background-color: transparent !important;
            }

            .header-section {
                display: flex !important;
                flex-direction: row !important; /* Ép nằm ngang */
                align-items: center !important;
                justify-content: flex-start !important; /* Căn trái toàn bộ nội dung header */
                gap: 2rem !important;
                padding-left: 12mm !important; /* Khớp với px-12 */
                padding-right: 12mm !important;
            }

            .header-info {
                text-align: left !important; /* Ép chữ căn trái */
                flex: 1 !important;
            }

            /* Ép thanh xanh (divider) luôn nằm bên trái */
            .header-divider {
                margin-left: 0 !important;
                margin-right: 0 !important;
                display: block !important;
                width: 6rem !important; /* w-24 */
            }

            /* Ép lưới thông tin liên hệ luôn 2 cột */
            .contact-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                text-align: left !important;
                gap: 0.5rem 1rem !important;
                font-size: 0.75rem !important;
            }

            .contact-item {
                justify-content: flex-start !important;
            }

            /* Học vấn & Kinh nghiệm: Luôn nằm ngang (Date bên trái, Nội dung bên phải) */
            .timeline-item {
                flex-direction: row !important;
                gap: 2.5rem !important;
                /* Tương đương gap-10 */
            }

            .timeline-date {
                width: 38mm !important;
                /* Tương đương sm:w-36 */
                flex-shrink: 0 !important;
            }

            /* Kỹ năng: Luôn chia 2 cột */
            .skills-grid {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 2rem !important;
            }

            /* Chống ngắt trang lỗi */
            /* section {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            } */

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
        }

        .material-icons-outlined {
            font-size: 18px;
            vertical-align: middle;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Prevents scrollbars in the preview */
            font-family: 'Inter', sans-serif;
        }

        .cv-container {
            width: 210mm;
            min-height: 297mm;
            background: white;
            display: flex;
            flex-direction: column;
            width: 100% !important;
            /* Force it to fill the iframe width */
            transform-origin: top left;
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-900 min-h-screen antialiased transition-colors duration-200">
    <div class="cv-container bg-white dark:bg-slate-800 shadow-xl min-h-screen overflow-hidden border-x border-slate-200 dark:border-slate-700">

        <!-- HEADER SECTION -->
        <div class="header-section px-6 py-6 md:px-12 flex flex-col md:flex-row items-center justify-center gap-6 md:gap-10 border-b border-slate-100 dark:border-slate-700">
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-slate-100 dark:bg-slate-700 flex-shrink-0 flex items-center justify-center overflow-hidden border-4 border-white dark:border-slate-600 shadow-md">
                <img alt="Profile Picture" class="w-full h-full object-cover" src="{{ $profile->avatar ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" />
            </div>

            <div class="header-info text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-extrabold text-primary dark:text-blue-400 leading-tight uppercase">
                    {{$profile->full_name ?? __('cv.user_name_default')}}
                </h1>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 font-medium mt-1 uppercase tracking-wide">
                    {{$profile->title ?? __('cv.title_default')}}
                </p>
                <div class="header-divider w-20 h-1 bg-primary dark:bg-blue-400 my-4 mx-auto md:mx-0"></div>

                <div class="contact-grid grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 text-md text-slate-500 dark:text-slate-400">
                    <div class="flex items-center justify-center md:justify-start gap-2 contact-item">
                        <span class="material-icons text-base text-slate-400">calendar_today</span>
                        <span>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-start gap-2 contact-item">
                        <span class="material-icons text-base text-slate-400">phone</span>
                        <span>{{ $profile->phone_number }}</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-start gap-2 contact-item">
                        <span class="material-icons text-base text-slate-400">email</span>
                        <span class="break-all">{{ $user->email }}</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-start gap-2 contact-item">
                        <span class="material-icons text-base text-slate-400">location_on</span>
                        <span>{{ !empty($profile->province_name) ? (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) : __('cv.address_default') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SUMMARY -->
        <section class="">
            <div class="bg-section-bg-light  py-2 px-6">
                <h2 class="font-bold text-lg uppercase tracking-widest text-slate-700 text-center">
                    {{ __('cv.summary') }}
                </h2>
            </div>
            <div class="px-6 md:px-12 py-4">
                <p class="text-xs leading-relaxed text-slate-600 dark:text-slate-300 text-justify">
                    {{ $profile->summary ?? __('cv.summary_default') }}
                </p>
            </div>
        </section>

        <!-- EDUCATION -->
        <section class="" id="education">
            <div class="bg-section-bg-light py-2 px-6">
                <h2 class="font-bold text-lg uppercase tracking-widest text-slate-700 text-center">
                    {{ __('cv.education') }}
                </h2>
            </div>
            <div class="px-6 md:px-12">
                @forelse($profile->educations as $edu)
                <div class="timeline-item py-4 flex flex-col sm:flex-row gap-2 sm:gap-10 border-b border-slate-50 dark:border-slate-700 last:border-0">
                    <div class="timeline-date sm:w-36 text-xs font-bold text-primary dark:text-blue-400 shrink-0">
                        {{ $edu->start_date->format('Y-m') }} — {{ $edu->end_date ? $edu->end_date->format('Y-m') : 'Hiện tại' }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 uppercase">
                            {{$edu->school}}
                        </h3>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-1">
                            {{ $edu->major }} {{ $edu->degree ? ' - '.$edu->degree : '' }}
                        </p>
                        @if($edu->description)
                        <p class="text-xs text-slate-500 dark:text-slate-400 italic mt-2">{{$edu->description}}</p>
                        @endif
                    </div>
                </div>
                @empty
                <p class="py-6 text-xs italic text-slate-400">{{ __('cv.no_education') }}</p>
                @endforelse
            </div>
        </section>

        <!-- WORK EXPERIENCE -->
        <section class="" id="experience">
            <div class="bg-section-bg-light py-2 px-6">
                <h2 class="font-bold text-lg uppercase tracking-widest text-slate-700 text-center">
                    {{ __('cv.work_experience') }}
                </h2>
            </div>
            <div class="px-6 md:px-12">
                @forelse($profile->experiences as $exp)
                <div class="timeline-item py-4 flex flex-col sm:flex-row gap-2 sm:gap-10 border-b border-slate-50 dark:border-slate-700 last:border-0 experience">
                    <div class="timeline-date sm:w-36 text-xs font-bold text-primary dark:text-blue-400 shrink-0">
                        {{$exp->start_date->format('Y-m')}} — {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('cv.present') }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 uppercase">
                            {{ $exp->company_name }}
                        </h3>
                        <p class="text-xs font-semibold text-secondary dark:text-blue-300 mt-1">
                            {{ $exp->position }}
                        </p>
                        <div class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                            {{ $exp->description }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="py-6 text-xs italic text-slate-400">{{ __('cv.no_experience') }}</p>
                @endforelse
            </div>
        </section>

        <!-- SKILLS -->
        @php
        $groupedSkills = collect($profile->skills)->groupBy('group');
        $coreGroups = $groupedSkills->except(['Soft Skill']);
        @endphp
        @if($coreGroups->count() > 0)
        <section class="" id="skills">
            <div class="bg-section-bg-light py-2 px-6">
                <h2 class="font-bold text-lg uppercase tracking-widest text-slate-700 text-center">
                    {{ __('cv.skills') }}
                </h2>
            </div>
            <div class="px-6 md:px-12 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($coreGroups as $groupName => $groupSkills)
                    <div class="project">
                        <h3 class="flex items-center gap-2 font-bold text-primary dark:text-blue-400 text-xs uppercase mb-3">
                            <span class="w-2 h-2 bg-primary dark:bg-blue-400 rounded-full"></span>
                            {{ $groupName }}
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($groupSkills as $skill)
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded text-xs font-medium border border-slate-200 dark:border-slate-600">
                                {{ $skill->name }}
                                @if($skill->year_of_experience)
                                <span class="opacity-60 ml-1">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</span>
                                @endif
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </div>
</body>

</html>