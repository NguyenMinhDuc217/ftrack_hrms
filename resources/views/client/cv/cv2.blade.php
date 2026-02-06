<!DOCTYPE html>
<html class="{{ $theme == 'dark' ? 'dark' : 'light' }}" lang=" vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CV2</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

    <link href="{{ asset('client/assets/font/inter.css') }}" rel="stylesheet" />

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
        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Prevents scrollbars in the preview */
        }

        .page {
            margin: 0 !important;
            /* Remove the auto-centering margin */
            box-shadow: none !important;
            /* Remove shadow for the preview */
            width: 100% !important;
            /* Force it to fill the iframe width */
            transform-origin: top left;
        }

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
                background: transparent !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
                overflow: visible !important;
            }

            .cv-header-container {
                width: 100% !important;
            }

            .cv-header {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                border-radius: 2rem !important;
            }

            .cv-header .name-container {
                text-align: left !important;
            }


            .cv-body-grid {
                display: grid !important;
                grid-template-columns: 3.5fr 6.5fr !important;
                /* Chia tỉ lệ 35/65 */
                gap: 20px !important;
                width: 100% !important;
            }

            aside {
                grid-column: span 1 !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 2px !important;
            }

            main {
                grid-column: span 1 !important;
                padding-left: 10px !important;
            }

            section,
            .timeline-item {
                display: block !important;
                width: 100% !important;
                clear: both;
            }

            .experience,
            .project,
            .information,
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

            .cv-body-grid {
                display: grid !important;
                grid-template-columns: 35% 65% !important;
                gap: 5px !important;
                width: 100% !important;
            }

            aside,
            main {
                float: none !important;
                /* Bỏ float */
                width: auto !important;
            }

            aside>div {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                display: block !important;
                position: relative !important;
            }

            aside>div:nth-child(2) {
                padding-top: 1mm !important;
            }

            aside>div:nth-child(3) {
                padding-top: 1mm !important;
                Ưu
            }

            .section-badge {
                position: absolute !important;
                top: -1 !important;
                /* Dùng margin âm thay cho absolute */
                z-index: 50 !important;
            }

            .absolute.-top-3 {
                position: absolute !important;
                top: -12px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                z-index: 50 !important;
            }

            .information,
            .summary {
                margin-top: 20px !important;
            }

        }

        body {
            font-family: 'Inter', sans-serif;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Prevents scrollbars in the preview */
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

<body class="bg-background-light dark:bg-background-dark min-h-screen !mb-0">
    <div class="cv-container w-full bg-white dark:bg-slate-900 shadow-xl rounded-lg overflow-hidden">
        <div class="cv-header-container p-8 pb-0">
            <div class="cv-header bg-card-green dark:bg-slate-800 rounded-[2rem] p-4 flex flex-col md:flex-row items-center gap-8">
                <div class="relative w-40 h-40 flex-shrink-0">
                    <img alt="Profile Picture" class="w-full h-full object-cover rounded-full border-4 border-white dark:border-slate-700 shadow-md" src="{{ $profile->avatar ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" />
                </div>
                <div class="text-center md:text-left name-container">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-primary uppercase tracking-tight">{{$profile->full_name ?? __('cv.user_name_default')}}</h1>
                    <p class="text-xl text-secondary dark:text-blue-400 font-semibold mt-2">{{$profile->title ?? __('cv.title_default')}}</p>
                </div>
            </div>
        </div>
        <div class="cv-body-grid p-8 grid grid-cols-1 md:grid-cols-12 gap-8">
            <aside class="md:col-span-4 space-y-6">

                <!-- Thông tin cá nhân -->
                <div class="bg-card-green dark:bg-slate-800 p-4 rounded-2xl relative">
                    <div class="bg-gradient-to-r from-orange-400 to-orange-300 dark:bg-yellow-900/30 px-4 py-1.5 rounded-full inline-block mb-6 absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <h3 class="text-white dark:text-yellow-200 font-bold text-xs">{{ __('cv.contact_info') }}</h3>
                    </div>

                    <ul class="space-y-2 text-xs text-gray-700 dark:text-slate-300">
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                                calendar_today
                            </span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') ?? 'N/A' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                                phone
                            </span>
                            <span class="font-medium">{{ $profile->phone_number ?? __('cv.phone_default') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                                email
                            </span>
                            <span class="font-medium">{{ $user->email ?? __('cv.email_default') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons bg-orange-400 text-white text-base rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                                home
                            </span>
                            <span class="font-medium">{{ !empty($profile->province_name) ? (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) : __('cv.address_default') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Summary -->
                <div>
                    <div class="bg-card-green dark:bg-slate-800 p-5 rounded-2xl relative summary">
                        <div class="bg-gradient-to-r from-orange-400 to-orange-300 dark:bg-yellow-900/30 px-4 py-1.5 rounded-full inline-block mb-6 absolute -top-3 left-1/2 transform -translate-x-1/2">
                            <h3 class="text-white dark:text-yellow-200 font-bold text-xs">{{ __('cv.summary') }}</h3>
                        </div>
                        <p class="text-xs leading-relaxed text-text-main dark:text-slate-300">
                            {{ $profile->summary ?? __('cv.summary_default') }}
                        </p>
                    </div>
                </div>

                <!-- Skills -->
                @php
                $groupedSkills = collect($profile->skills)->groupBy('group');
                $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
                $coreGroups = $groupedSkills->except(['Soft Skill']);
                @endphp
                @if($coreGroups->count() > 0)
                <div class="">
                    <div class="cv-card bg-card-green dark:bg-slate-800 p-5 rounded-2xl relative information">
                        <div class="cv-card-header flex justify-between">
                            <div class="section-badge bg-gradient-to-r from-orange-400 to-orange-300 dark:bg-yellow-900/30 px-4 py-1.5 rounded-full inline-block mb-6 absolute -top-3 left-1/2 transform -translate-x-1/2">
                                <h3 class="text-white dark:text-yellow-200 font-bold text-xs">{{ __('cv.skills') }}</h3>
                            </div>
                        </div>
                        <div class="p-5 pt-2 w-full text-text-main dark:text-slate-300">
                            <ul class="space-y-2 text-xs text-text-main dark:text-slate-300">

                                @foreach($coreGroups as $groupName => $groupSkills)
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ $groupName }}
                                </li>
                                @if($groupSkills->count() > 0)
                                <ul class="list-disc pl-8">
                                    @foreach($groupSkills as $skill)
                                    <li class="fw-normal  text-xs break-all leading-relaxed">
                                        <span class="">{{ $skill->name ?? '' }}</span>
                                        @if($skill->year_of_experience)
                                        <small class="fw-bold">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</small>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

            </aside>

            <main class="md:col-span-8 space-y-6">

                <!-- Education -->
                <section>
                    <div class="bg-card-green dark:bg-emerald-900/20 rounded-lg px-4 py-2 mb-6">
                        <h3 class="text-primary font-bold text-lg uppercase">{{ __('cv.education') }}</h3>
                    </div>
                    @if($profile->educations->isEmpty())
                    <p class="text-muted fst-italic">{{ __('cv.no_education') }}</p>
                    @else
                    @foreach($profile->educations as $edu)
                    <div class="space-y-6 relative">
                        <div class="timeline-item relative pl-10">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-secondary rounded-full flex items-center justify-center text-white z-10">
                                <span class="material-icons text-xs">school</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-between mb-1">
                                <h4 class="font-bold text-primary">{{$edu->school}}</h4>
                                <span class="text-primary text-xs font-semibold">{{ $edu->start_date->format('Y-m') }} — {{ $edu->end_date ? $edu->end_date->format('Y-m') : 'Present' }}</span>
                            </div>
                            @if(!empty($edu->description))
                            <p class="font-bold text-secondary dark:text-blue-400 mb-2">{{$edu->description}}</p>
                            @endif
                            <ul class="list-disc list-inside space-y-1 text-xs text-text-main dark:text-slate-300 ml-2">
                                <li>{{$edu->degree ?? ''}} {{ $edu->major ? ': ' . $edu->major : '' }}</li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </section>

                <!-- Experience -->
                <section>
                    <div class="bg-card-green dark:bg-emerald-900/20 rounded-lg px-4 py-2 mb-6">
                        <h3 class="text-primary font-bold text-lg uppercase">{{ __('cv.work_experience') }}</h3>
                    </div>
                    @if($profile->experiences->isEmpty())
                    <p class="text-muted fst-italic">{{ __('cv.no_experience') }}</p>
                    @else
                    <div class="space-y-8 relative">
                        @foreach($profile->experiences as $exp)
                        <div class="timeline-item relative pl-10 experience">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-secondary rounded-full flex items-center justify-center text-white z-10">
                                <span class="material-icons text-xs">business_center</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-between mb-1">
                                <h4 class="font-bold text-primary">{{$exp->position}}</h4>
                                <span class="text-primary text-xs font-semibold">{{$exp->start_date->format('Y-m')}} — {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('cv.present') }}</span>
                            </div>
                            <p class="font-bold text-secondary dark:text-blue-400 mb-3">{{$exp->company_name}}</p>
                            <div class="text-muted whitespace-pre-line list-disc list-inside space-y-2 text-xs text-text-main dark:text-slate-300 ml-2">{{ $exp->description ? trim($exp->description) : '' }}</div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </section>

                <!-- Project -->
                @if(!$profile->projects->isEmpty())
                <section>
                    <div class="bg-card-green dark:bg-emerald-900/20 rounded-lg px-4 py-2 mb-6">
                        <h3 class="text-primary font-bold text-lg uppercase">{{ __('cv.projects') }}</h3>
                    </div>
                    <div class="space-y-8 relative">
                        @foreach($profile->projects as $project)
                        <div class="timeline-item relative pl-10 experience">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-secondary rounded-full flex items-center justify-center text-white z-10">
                                <span class="material-icons text-xs">business_center</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-between mb-1">
                                <h4 class="font-bold text-primary">{{ $project->name }}</h4>
                            </div>
                            <div class="text-muted whitespace-pre-line list-disc list-inside space-y-2 text-xs text-text-main dark:text-slate-300">{{ $project->description ? trim($project->description) : '' }}</div>
                            @if(!empty($project->url))
                            <a href="{{ $project->url }}" target="_blank" class="text-primary small text-xs text-decoration-none fw-medium">
                                {{ $project->url }} <i class="ti ti-external-link ms-1"></i>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

            </main>
        </div>
    </div>

</body>

</html>