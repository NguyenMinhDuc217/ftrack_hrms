    <style>
        :root {
            --font-primary: 'Inter', system-ui, -apple-system, sans-serif;
            --bg-body: #f9fafb;
            --card-bg: #ffffff;
            --accent: #2563eb;
            /* Blue-600 */
            --accent-light: #dbeafe;
            --accent-hover: #3b82f6;
            --text-primary: #111827;
            --text-secondary: #4b5563;
            --text-muted: #6b7280;
            --border-light: #e5e7eb;
            --border-medium: #d1d5db;
        }

        body {
            font-family: var(--font-primary);
            background-color: var(--bg-body);
            color: var(--text-primary);
            line-height: 1.6;
            padding-bottom: 100px;
        }

        section,
        .section {
            background-color: transparent;
        }

        /* Card kiểu sạch - rất ít shadow */
        .clean-card {
            background: var(--card-bg);
            border: 1px solid var(--border-light);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .clean-card:hover {
            border-color: var(--border-medium);
            transform: translateY(-2px);
        }

        /* Hero Header - sạch và nổi bật */
        .hero-section {
            background: linear-gradient(to bottom right, #ffffff, var(--accent-light));
            padding: 2rem 1rem;
            text-align: center;
            margin-bottom: 2rem;
            border: 1px solid var(--border-light);
        }

        .profile-img-container {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            /* overflow: hidden; */
            margin: 0 auto 1.5rem;
            border: 8px solid white;
            box-shadow: 0 0 0 4px var(--accent-light);
        }

        .profile-img-container img {
            max-width: 200px;
            max-height: 183px;
            aspect-ratio: 1;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Buttons hiện đại, không shadow */
        .btn-primary-clean {
            background: var(--accent);
            color: white;
            border: none;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary-clean:hover {
            background: var(--accent-hover);
            transform: scale(1.03);
        }

        .btn-secondary-clean {
            background: transparent;
            color: var(--text-secondary);
            border: 1.5px solid var(--border-medium);
            padding: 0.875rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary-clean:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* Section Title */
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
            padding-top: 0;
        }

        /* .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        } */

        /* Skills Badge - sạch và đẹp */
        .skill-badge {
            background: var(--accent-light);
            color: var(--accent);
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            font-size: 0.925rem;
            border: 1px solid #bfdbfe;
        }

        /* Soft Badge Style */
        .badge-soft-blue {
            background-color: #eff6ff;
            /* blue-50 */
            color: #1d4ed8;
            /* blue-700 */
            font-weight: 600;
        }

        /* Timeline - tối giản, đẹp mắt */
        .timeline-item {
            display: flex;
            gap: 2rem;
            padding-bottom: 3rem;
            position: relative;
        }

        .timeline-marker {
            flex-shrink: 0;
            width: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timeline-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--accent);
            border: 4px solid white;
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .timeline-line {
            width: 2px;
            background: var(--border-light);
            flex-grow: 1;
            margin-top: 8px;
        }

        /* .timeline-item:last-child .timeline-line {
            display: none;
        } */

        .timeline-content {
            flex: 1;
        }

        .timeline-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .company-name {
            color: var(--accent);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Contact items */
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            /* padding: 0.75rem 0; */
            color: var(--text-secondary);
        }

        .contact-item i {
            font-size: 1.25rem;
            color: var(--accent);
            width: 28px;
        }

        /* Project card */
        .project-card {
            overflow: hidden;
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .project-card:hover {
            border-color: var(--accent-light);
            transform: translateY(-4px);
        }

        .project-img {
            height: 120px;
            overflow: hidden;
            background: #1f2937;
        }

        .project-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            transition: all 0.3s;
        }

        .project-card:hover img {
            opacity: 1;
            transform: scale(1.05);
        }

        .invalid-note {
            color: #dc3545;
            font-size: 0.8rem;
        }

        #preview-body,
        #previewModal,
        #pdf-preview {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #preview-body::-webkit-scrollbar,
        #previewModal::-webkit-scrollbar,
        #pdf-preview::-webkit-scrollbar {
            display: none;
        }

        .action-btn {
            cursor: pointer;
            display: none !important;
        }
    </style>

    <!-- Hero Section -->
    <div class="container px-0">
        <div class="hero-section">
            <div class="profile-img-container">
                <div class="position-relative d-inline-block">
                    <img class="img-fluid rounded-circle border shadow-sm" alt="Profile" src="{{ $profile->avatar ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" />

                    <div class="position-absolute bottom-0 end-0 bg-white rounded-circle border p-1" style="cursor: pointer; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center;" onclick="openModal('summaryModal')">
                        <i class="ti ti-camera fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
            <h1 class="display-5 fw-bold mb-2">{{$profile->full_name ?? __('cv.user_name_default')}}</h1>
            <p class="fs-3 text-muted mb-2">{{$profile->title ?? __('cv.title_default')}}</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-2">
                <button class="btn-primary-clean d-flex align-items-center gap-2">
                    <i class="ti ti-download"></i> Download Resume
                </button>
                <button class="btn-secondary-clean d-flex align-items-center gap-2">
                    <i class="ti ti-mail"></i> Contact Candidate
                </button>
                <button class="btn-secondary-clean d-flex align-items-center gap-2">
                    <i class="ti ti-share"></i> Share Profile
                </button>

            </div>
        </div>
    </div>

    <main class="container pb-5 px-0">
        <div class="row g-5">

            <!-- LEFT COLUMN -->
            <aside class="col-lg-1 col-xl-1">

            </aside>

            <!-- RIGHT COLUMN -->
            <section class="col-lg-10 col-xl-10">
                <div class="d-flex flex-column gap-5 pt-1">

                    <!-- Contact Information -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title h5 fw-bold text-dark m-0 text-left">{{ __('cv.contact_info') }}</h2>
                            <button onclick="openModal('summaryModal')" class="action-btn"><i class="ti ti-pencil text-success"></i></button>
                        </div>
                        <hr class="mb-2" />
                        <div class="d-flex flex-row gap-3 justify-between">
                            <div class="d-flex flex-column gap-3">
                                <div class="contact-item"><i class="ti ti-calendar-event"></i>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') ?? __('cv.dob_default') }}</div>
                                <div class="contact-item"><i class="ti ti-user"></i> {{ !empty($profile->gender) ? $profile->gender->getLabel()['lang'] : __('cv.gender_default') }}</div>
                                <div class="contact-item"><i class="ti ti-map-pin"></i> {{ !empty($profile->province_name) ? (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) : __('cv.address_default') }}</div>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                <div class="contact-item"><i class="ti ti-phone"></i> {{ $profile->phone_number ?? __('cv.phone_default') }}</div>
                                <div class="contact-item break-all"><i class="ti ti-mail"></i> {{ $user->email ?? __('cv.email_default') }}</div>
                            </div>
                            <div class="d-flex flex-column gap-3">
                            </div>
                        </div>
                    </div>



                    <!-- Summary -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title h4 fw-bold text-dark m-0">{{ __('cv.summary') }}</h2>
                            <button onclick="openModal('summaryModal')" class="action-btn"><i class="ti ti-pencil text-success"></i></button>
                        </div>
                        <hr />
                        {{-- <h2 class="section-title d-flex justify-content-between align-items-center">
                            {{ __('cv.summary') }}
                        <button onclick="openModal('summaryModal')"><i class="ti ti-pencil text-success"></i></button>
                        </h2> --}}
                        <p class="fs-5 text-muted lh-lg">
                            {{ $profile->summary ?? __('cv.summary_default') }}
                        </p>
                    </div>

                    <!-- Work Experience -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title h4 fw-bold text-dark m-0">{{ __('cv.work_experience') }}</h2>
                            <button class="btn btn-light text-success bg-success-subtle rounded-0 btn-sm fw-medium d-inline-flex align-items-center gap-1 action-btn" onclick="openModal('experienceModal')">
                                <i class="ti ti-plus"></i> {{ __('cv.add') }}
                            </button>
                        </div>
                        <hr class="mb-2" />
                        @if($profile->experiences->isEmpty())
                        <p class="text-muted fst-italic">{{ __('cv.no_experience') }}</p>
                        @else
                        <div>
                            @foreach($profile->experiences as $exp)
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-line"></div>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h3 class="h5 fw-bold mb-1">{{$exp->position}}</h3>
                                            <div class="company-name mb-1">{{$exp->company_name}}</div>
                                            <div class="text-muted small mb-3">{{$exp->start_date->format('Y-m')}} — {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('cv.present') }}</div>
                                            <div class="text-muted whitespace-pre-line">{!! $exp->description !!}</div>
                                        </div>
                                        <div class="d-flex gap-3 opacity-75">
                                            <i class="ti ti-pencil text-muted cursor-pointer action-btn" onclick='openModal("experienceModal", @json($exp))'></i>
                                            <i class="ti ti-trash text-danger cursor-pointer action-btn" onclick="deleteItem('{{ route('profile.delete.experience', $exp->id) }}', '#container-experience')"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Education -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title h4 fw-bold text-dark m-0">{{ __('cv.education') }}</h2>
                            <button class="btn btn-light text-success bg-success-subtle rounded-0 btn-sm fw-medium d-inline-flex align-items-center gap-1 action-btn" onclick="openModal('educationModal')">
                                <i class="ti ti-plus"></i> {{ __('cv.add') }}
                            </button>
                        </div>
                        <hr class="mb-2" />
                        @if($profile->educations->isEmpty())
                        <p class="text-muted fst-italic">{{ __('cv.no_education') }}</p>
                        @else
                        <div>
                            @foreach($profile->educations as $edu)
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-line"></div>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h3 class="h5 fw-bold mb-1">{{$edu->school}}</h3>
                                            <div class="text-primary fw-medium mb-1">{{$edu->degree ?? ''}} {{ $edu->major ? 'in ' . $edu->major : '' }}</div>
                                            <div class="text-muted small">{{ $edu->start_date->format('Y-m') }} — {{ $edu->end_date ? $edu->end_date->format('Y-m') : 'Present' }}</div>
                                            @if(!empty($edu->description))
                                            <p class="text-muted mt-3">{{$edu->description}}</p>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-3 opacity-75">
                                            <i class="ti ti-pencil text-muted cursor-pointer action-btn" onclick='openModal("educationModal", @json($edu))'></i>
                                            <i class="ti ti-trash text-danger cursor-pointer action-btn" onclick="deleteItem('{{ route('profile.delete.education', $edu->id) }}', '#container-education')"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Skills -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title h4 fw-bold text-dark m-0">{{ __('cv.skills') }}</h2>
                            <button onclick="openSkillModal('Core')" class="action-btn"><i class="ti ti-plus text-success"></i></button>
                        </div>
                        <hr class="mb-2" />
                        @php
                        $groupedSkills = collect($profile->skills)->groupBy('group');
                        $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
                        $coreGroups = $groupedSkills->except(['Soft Skill']);
                        @endphp

                        @foreach($coreGroups as $groupName => $groupSkills)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="h6 fw-bold text-uppercase text-muted letter-spacing-1">{{$groupName}}</h3>
                                <div class="d-flex gap-3">
                                    <i class="ti ti-pencil text-muted cursor-pointer action-btn" onclick='openSkillModal("Core", @json($groupName), @json($groupSkills))'></i>
                                    <i class="ti ti-trash text-danger cursor-pointer action-btn" onclick="deleteSkillGroup('{{ $groupName }}')"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach($groupSkills as $skill)
                                <span class="badge badge-soft-blue px-3 py-2 rounded-0 fw-normal">
                                    {{ $skill->name }}
                                    @if($skill->year_of_experience)
                                    <small class="fw-bold">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</small>
                                    @endif
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        @if($softSkills->isNotEmpty())
                        <hr />
                        <div class="mb-4">
                            <h3 class="h6 fw-bold text-uppercase text-muted letter-spacing-1 mb-3">{{ __('cv.soft_skills') }}</h3>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($softSkills as $skill)
                                <span class="skill-badge">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Portfolio & Projects -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title h4 fw-bold text-dark m-0">{{ __('cv.projects') }}</h2>
                            <button class="btn btn-light text-success bg-success-subtle rounded-0 btn-sm fw-medium d-inline-flex align-items-center gap-1 action-btn" onclick="openModal('projectModal')">
                                <i class="ti ti-plus"></i> {{ __('cv.add') }}
                            </button>
                        </div>
                        <hr class="mb-2" />
                        @if($profile->projects->isEmpty())
                        <p class="text-muted fst-italic">{{ __('cv.no_projects') }}</p>
                        @else
                        <div class="row g-4">
                            @foreach($profile->projects as $project)
                            <div class="col-md-6 col-lg-4">
                                <div class="project-card h-100 d-flex flex-column">
                                    <div class="project-img d-none">
                                        <img src="{{ $project->image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuBxj-XsEhGOX52xBvvuO_Sn8NqMmJoBU2GsAPb9UofWCS-WcBwl3sVHIjIxZvbvUGvYuP6fZmnsVJJgDdkkyizhExumZKHFPLdBkwThuzlG2PP-_IJsZBlZy7asgJgzhAw5uiHGPbqCpVUOqZLgRKjcqG1VAG3OYxl6acSbe-cq0Z-5aYnbtky-61M1wQNjp7RehROVWKB2LwMjKMMNuxntnemC3dsFDzESUYezkBPM0NNHtTV1XComDdoBXBrYingY4F5dSTlA86Je' }}"
                                            alt="{{ $project->name }}"
                                            class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="p-4 flex-grow-1 d-flex flex-column">
                                        <h3 class="h6 fw-bold mb-2">{{$project->name}}</h3>
                                        <p class="text-muted small flex-grow-1 mb-3">{{$project->description}}</p>
                                        @if(!empty($project->url))
                                        <a href="{{ $project->url }}" target="_blank" class="text-primary small text-decoration-none fw-medium">
                                            {{ $project->url }} <i class="ti ti-external-link ms-1"></i>
                                        </a>
                                        @endif
                                        <div class="mt-3 d-flex gap-3 opacity-75">
                                            <i class="ti ti-pencil text-muted cursor-pointer action-btn" onclick='openModal("projectModal", @json($project))'></i>
                                            <i class="ti ti-trash text-danger cursor-pointer action-btn" onclick="deleteItem('{{ route('profile.delete.project', $project->id) }}', '#container-projects')"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                </div>
            </section>
        </div>
    </main>