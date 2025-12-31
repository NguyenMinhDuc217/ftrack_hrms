@extends('layouts.client')

@section('title', __('cv.profile'))

@section('content')

    <style>
        :root {
            --font-primary: 'Inter', system-ui, -apple-system, sans-serif;
            --bg-body: #f9fafb;
            --card-bg: #ffffff;
            --accent: #2563eb;         /* Blue-600 */
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

        /* Card kiểu sạch - rất ít shadow */
        .clean-card {
            background: var(--card-bg);
            border-radius: 1.5rem;
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
            border-radius: 2rem;
            padding: 4rem 2rem;
            text-align: center;
            margin-bottom: 4rem;
            border: 1px solid var(--border-light);
        }

        .profile-img-container {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1.5rem;
            border: 8px solid white;
            box-shadow: 0 0 0 4px var(--accent-light);
        }

        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Buttons hiện đại, không shadow */
        .btn-primary-clean {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 9999px;
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
            border-radius: 9999px;
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
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        /* Skills Badge - sạch và đẹp */
        .skill-badge {
            background: var(--accent-light);
            color: var(--accent);
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.925rem;
            border: 1px solid #bfdbfe;
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

        .timeline-item:last-child .timeline-line {
            display: none;
        }

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
            padding: 0.75rem 0;
            color: var(--text-secondary);
        }

        .contact-item i {
            font-size: 1.25rem;
            color: var(--accent);
            width: 28px;
        }

        /* Project card */
        .project-card {
            border-radius: 1rem;
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
    </style>

    <!-- Hero Section -->
    <div class="container">
        <div class="hero-section">
            <div class="profile-img-container">
                <img alt="Profile" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBv1WJeajgaDN6vx1Mp1ukMAot0XI9Xdt5YczTfIMMvdidDw8bWPYY81CYbQSRTx8GPftleve8Fq11s-MQ5OCYGlmxwKyeKCvWm0-k1NyMZ6lCCWc_l2kXpBXIEy8Yuya95Dy5Atj8j0XRF15Y8Bii3sEu_bhLq3V-oB4WQpG7n45UjcrMiZDX68XqmpcJA0ZopYabC-wINrHDmDk2ziY9tXDjJKXAOAUS3wnyqDLI9fXAfJtX_iPsMNXT5nGq02TMmJHobRtpUMoH9"/>
            </div>
            <h1 class="display-5 fw-bold mb-2">{{$profile->full_name ?? __('cv.user_name_default')}}</h1>
            <p class="fs-3 text-muted mb-4">{{$profile->title ?? __('cv.title_default')}}</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
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

    <main class="container pb-5">
        <div class="row g-5">

            <!-- LEFT COLUMN -->
            <aside class="col-lg-4 col-xl-3">
                <div class="d-flex flex-column gap-5">

                    <!-- Contact Information -->
                    <div class="clean-card">
                        <h2 class="section-title">Contact Information</h2>
                        <div class="d-flex flex-column gap-3">
                            <div class="contact-item"><i class="ti ti-mail"></i> {{ $user->email ?? __('cv.email_default') }}</div>
                            <div class="contact-item"><i class="ti ti-phone"></i> {{ $profile->phone_number ?? __('cv.phone_default') }}</div>
                            <div class="contact-item"><i class="ti ti-calendar-event"></i> {{ $user->date_of_birth ?? __('cv.dob_default') }}</div>
                            <div class="contact-item"><i class="ti ti-user"></i> {{ !empty($profile->gender) ? $profile->gender->getLabel()['lang'] : __('cv.gender_default') }}</div>
                            <div class="contact-item"><i class="ti ti-map-pin"></i> {{ !empty($profile->province_name) ? (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) : __('cv.address_default') }}</div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="clean-card">
                        <h2 class="section-title">Skills</h2>
                        @php
                            $groupedSkills = collect($profile->skills)->groupBy('group');
                            $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
                            $coreGroups = $groupedSkills->except(['Soft Skill']);
                        @endphp

                        @foreach($coreGroups as $groupName => $groupSkills)
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="h6 fw-bold text-uppercase text-muted letter-spacing-1">{{$groupName}}</h3>
                                    <div class="d-flex gap-3">
                                        <i class="ti ti-pencil text-muted fs-5" onclick='openSkillModal("Core", @json($groupName), @json($groupSkills))'></i>
                                        <i class="ti ti-trash text-danger fs-5" onclick="deleteSkillGroup('{{ $groupName }}')"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($groupSkills as $skill)
                                        <span class="skill-badge">
                                            {{ $skill->name }}
                                            @if($skill->year_of_experience)
                                                <small class="fw-normal opacity-80">({{ trans_choice('cv.years_count', $skill->year_of_experience) }})</small>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        @if($softSkills->isNotEmpty())
                            <div class="mb-4">
                                <h3 class="h6 fw-bold text-uppercase text-muted letter-spacing-1 mb-3">Soft Skills</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($softSkills as $skill)
                                        <span class="skill-badge">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>

            <!-- RIGHT COLUMN -->
            <section class="col-lg-8 col-xl-9">
                <div class="d-flex flex-column gap-5">

                    <!-- Summary -->
                    <div class="clean-card">
                        <h2 class="section-title d-flex justify-content-between align-items-center">
                            Summary
                            <button onclick="openModal('summaryModal')"><i class="ti ti-pencil text-muted"></i></button>
                        </h2>
                        <p class="fs-5 text-muted lh-lg">
                            {{ $profile->summary ?? __('cv.summary_default') }}
                        </p>
                    </div>

                    <!-- Work Experience -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="section-title">Work Experience</h2>
                            <button class="btn-primary-clean btn-sm d-flex align-items-center gap-2">
                                <i class="ti ti-plus"></i> Add Experience
                            </button>
                        </div>

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
                                                    <div class="text-muted small mb-3">{{$exp->start_date}} — {{$exp->end_date ?? 'Present'}}</div>
                                                    <p class="text-muted">{{$exp->description}}</p>
                                                </div>
                                                <div class="d-flex gap-3 opacity-75">
                                                    <i class="ti ti-pencil text-muted cursor-pointer" onclick='openModal("experienceModal", @json($exp))'></i>
                                                    <i class="ti ti-trash text-danger cursor-pointer" onclick="deleteItem('{{ route('profile.delete.experience', $exp->id) }}', '#container-experience')"></i>
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
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="section-title">Education</h2>
                            <button class="btn-primary-clean btn-sm d-flex align-items-center gap-2">
                                <i class="ti ti-plus"></i> Add Education
                            </button>
                        </div>

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
                                                    <div class="text-muted small">{{$edu->start_date}} — {{$edu->end_date ?? 'Present'}}</div>
                                                    @if(!empty($edu->description))
                                                        <p class="text-muted mt-3">{{$edu->description}}</p>
                                                    @endif
                                                </div>
                                                <div class="d-flex gap-3 opacity-75">
                                                    <i class="ti ti-pencil text-muted cursor-pointer" onclick='openModal("educationModal", @json($edu))'></i>
                                                    <i class="ti ti-trash text-danger cursor-pointer" onclick="deleteItem('{{ route('profile.delete.education', $edu->id) }}', '#container-education')"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Portfolio & Projects -->
                    <div class="clean-card">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="section-title">Portfolio & Projects</h2>
                            <button class="btn-primary-clean btn-sm d-flex align-items-center gap-2">
                                <i class="ti ti-plus"></i> Add Project
                            </button>
                        </div>

                        @if($profile->projects->isEmpty())
                            <p class="text-muted fst-italic">{{ __('cv.no_projects') }}</p>
                        @else
                            <div class="row g-4">
                                @foreach($profile->projects as $project)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="project-card h-100 d-flex flex-column">
                                            <div class="project-img">
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
                                                    <i class="ti ti-pencil text-muted cursor-pointer" onclick='openModal("projectModal", @json($project))'></i>
                                                    <i class="ti ti-trash text-danger cursor-pointer" onclick="deleteItem('{{ route('profile.delete.project', $project->id) }}', '#container-projects')"></i>
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

    <!-- MODALS & SCRIPTS giữ nguyên như cũ -->
    @include('cv.modal.education')
    @include('cv.modal.education')
    @include('cv.modal.experience')
    @include('cv.modal.language')
    @include('cv.modal.skill')
    @include('cv.modal.award')
    @include('cv.modal.certificate')
    @include('cv.modal.project')
    @include('cv.modal.summary')

    @push('scripts')
        <script>
            $(()=>{
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                $('input[type="month"]').on('focus', function() {
                    this.showPicker();
                });

                $('input[name="is_current"]').on('change', function() {
                    const $form = $(this).closest('form');
                    if ($(this).is(':checked')) {
                        $form.find('input[name="end_date"]').prop('disabled', true).val('');
                    } else {
                        $form.find('input[name="end_date"]').prop('disabled', false);
                    }
                });
            });


            // 1. Open Generic Modal & Populate Data
            window.openModal = function(modalId, data = null) {
                let $modal = $('#' + modalId);
                let $form = $modal.find('form');

                // init datepicker
                // https://mymth.github.io/vanillajs-datepicker/#/
                $form.find('.input-datepicker').each(function() {
                    new Datepicker(this, {
                        format: 'yyyy-mm-dd',
                        buttonClass: 'btn',
                        maxDate: new Date(),
                        autohide: true
                    });
                });
                $form.find('.input-datepicker-month').each(function() {
                    new Datepicker(this, {
                        format: 'yyyy-mm',
                        buttonClass: 'btn',
                        maxDate: new Date(),
                        autohide: true,
                        pickLevel: 1,
                    });
                });
                $form.find('.input-datepicker-year').each(function() {
                    new Datepicker(this, {
                        format: 'yyyy',
                        buttonClass: 'btn',
                        maxDate: new Date(),
                        autohide: true,
                        pickLevel: 2,
                    });
                });

                $form[0].reset(); // Clear old data
                $form.find('input[type="hidden"]').val(''); // Clear ID

                // hide old error messages
                $form.find('.is-invalid').removeClass('is-invalid');
                $form.find('.invalid-note').text('');

                if (data) {
                    // Loop through JSON data and populate inputs by name
                    $.each(data, function(key, value) {
                        let $input = $form.find(`[name="${key}"]`);
                        if ($input.length) {
                            if ($input.attr('type') === 'checkbox') {
                                $input.prop('checked', value == 1);
                            } else if ($input.attr('type') === 'text' && $input.hasClass('input-datepicker-month') && value) {
                                $input.val(value.substring(0, 7));
                            } else if ($input.attr('type') === 'date' && value) {
                                // Fix date format for input type=date (YYYY-MM-DD)
                                $input.val(value.split('T')[0]);
                            } else {
                                $input.val(value);
                            }
                        }
                    });
                }

                new bootstrap.Modal(document.getElementById(modalId)).show();
            }

            // 2. Generic Save Handler (AJAX)
            $(document).on('submit', '.ajax-form', function(e) {
                e.preventDefault();

                let $form = $(this);
                let url = $form.data('route');
                // let container = $form.data('container');
                let container = '#container-profile';
                let modalEl = $form.closest('.modal')[0];
                const checkFormMultiPart = $form.attr('enctype') === 'multipart/form-data';
                // hide old error messages
                $form.find('.is-invalid').removeClass('is-invalid');
                $form.find('.invalid-note').text('');

                if(checkFormMultiPart) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: new FormData($form[0]),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if(response.status === 'error') {
                                $.each(response.errors, function(key, value) {
                                    $form.find(`[name="${key}"]`).addClass('is-invalid');
                                    $form.find(`[name="${key}"]`).parent().find('.invalid-note').text(value[0]);
                                });
                            } else {
                                $(container).html(response); // Update HTML
                                bootstrap.Modal.getInstance(modalEl).hide(); // Hide Modal
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                } else {
                    $.post(url, $form.serialize(), function(response) {
                        if(response.status === 'error') {
                            $.each(response.errors, function(key, value) {
                                $form.find(`[name="${key}"]`).addClass('is-invalid');
                                $form.find(`[name="${key}"]`).parent().find('.invalid-note').text(value[0]);
                            });
                        } else {
                            $(container).html(response); // Update HTML
                            bootstrap.Modal.getInstance(modalEl).hide(); // Hide Modal
                        }
                    }).fail(function() { alert('{{ __('cv.save_error') }}'); });
                }
            });

            // 3. Generic Delete Handler
            window.deleteItem = async function(url, container) {
                const confirmResult = await Swal.fire({
                    title: '{{ __('cv.confirm_delete_title') }}',
                    text: "{{ __('cv.confirm_delete_text') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('cv.confirm_delete_yes') }}',
                    cancelButtonText: '{{ __('cv.confirm_delete_cancel') }}',
                    reverseButtons: true,
                });
                if (!confirmResult.isConfirmed) return;
                $.ajax({
                    url: url, type: 'DELETE',
                    success: function(response) { $(container).html(response); },
                    error: function() { alert('{{ __('cv.delete_error') }}'); }
                });
            }

            // // 4. Specific Summary Handler (Toggle View/Edit)
            // $(document).on('click', '#btn-edit-summary', function() {
            //     $('#summary-view').addClass('d-none');
            //     $('#summary-edit').removeClass('d-none');
            // });
            // $(document).on('click', '#btn-cancel-summary', function() {
            //     $('#summary-edit').addClass('d-none');
            //     $('#summary-view').removeClass('d-none');
            // });
            // $(document).on('submit', '#form-summary', function(e) {
            //     e.preventDefault();
            //     $.post("{{ route('profile.save.summary') }}", $(this).serialize(), function(response) {
            //         $('#container-summary').html(response);
            //     });
            // });

            // SKILL #
            let currentSkills = [];
            let skillModal = null;

            function toggleSkillGroup(selectElement) {
                console.log(selectElement);
                const selectedValue = selectElement.value;
                const skillExperience = document.getElementById('skillExperience');
                if (selectedValue === 'Soft Skill') {
                    skillExperience.style.display = 'none';
                } else {
                    skillExperience.style.display = 'block';
                }
            }

            function checkSkillType() {
                const skillGroupSoft = document.getElementById('skillGroup-soft');
                if (skillGroupSoft) {
                    document.getElementById('btn-soft-skill').classList.add('disabled');
                } else {
                    document.getElementById('btn-soft-skill').classList.remove('disabled');
                }
            }
            // Open Modal Function
            window.openSkillModal = function(type, groupName = '', skills = []) {
                // Reset State
                currentSkills = skills.map(s => ({
                    name: s.name,
                    year_of_experience: s.year_of_experience
                }));

                // Set UI Mode
                $('#skillType').val(type);
                $('#skillOldGroup').val(groupName); // If editing, this is the identifier

                if (type === 'Soft') {
                    $('#skillModalTitle').text('{{ __('cv.soft_skills') }}');
                    $('#skillGroupNameContainer').hide();
                    $('#skillGroupName').val('Soft Skill'); // Fixed name
                    $('#newSkillExpContainer').hide(); // No exp for soft skills
                } else {
                    $('#skillModalTitle').text(groupName ? '{{ __('cv.edit') }} {{ __('cv.core_skills') }}' : '{{ __('cv.add') }} {{ __('cv.core_skills') }}');
                    $('#skillGroupNameContainer').show();
                    $('#skillGroupName').val(groupName);
                    $('#newSkillExpContainer').show();
                }

                // Clear Inputs
                $('#newSkillName').val('');
                $('#newSkillExp').val('');

                renderSkillList();
                skillModal = new bootstrap.Modal(document.getElementById('skillModal'));
                skillModal.show();
            }

            // Add Skill to Array
            window.addSkillToList = function() {
                const name = $('#newSkillName').val().trim();
                const exp = $('#newSkillExp').val();
                const type = $('#skillType').val();

                if (!name) return;

                currentSkills.push({
                    name: name,
                    year_of_experience: type === 'Core' ? exp : null
                });

                // Reset Inputs
                $('#newSkillName').val('').focus();
                $('#newSkillExp').val('');

                renderSkillList();
            }

            // Remove Skill
            window.removeSkill = function(index) {
                currentSkills.splice(index, 1);
                renderSkillList();
            }

            // Render List
            function renderSkillList() {
                const $container = $('#skillListContainer');
                $container.empty();
                $('#skillCount').text(currentSkills.length);

                currentSkills.forEach((skill, index) => {
                    let badgeClass = $('#skillType').val() === 'Soft' ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary';
                    let expText = skill.year_of_experience ? `<small class="ms-1">(${skill.year_of_experience} yrs)</small>` : '';

                    let html = `
                <span class="badge ${badgeClass} border p-2 rounded-pill d-flex align-items-center">
                    <span>${skill.name}${expText}</span>
                    <i class="ti ti-x ms-2 action-btn" onclick="removeSkill(${index})"></i>
                </span>
            `;
                    $container.append(html);
                });
            }

            // Save Handler
            function saveSkillGroup(e) {
                e.preventDefault();

                const groupName = $('#skillGroupName').val().trim();
                if (!groupName) {
                    alert('{{ __('cv.group_name_required') }}');
                    return;
                }

                $.post("{{ route('profile.save.skill-group') }}", {
                    group: groupName,
                    old_group: $('#skillOldGroup').val(),
                    skills: currentSkills,
                }, function(response) {
                    skillModal.hide();
                    delete skillModal;
                    $('#container-profile').html(response);
                }).fail(function() {
                    alert('{{ __('cv.error_saving_skills') }}');
                });
            };

            // Delete Group Handler
            window.deleteSkillGroup = async function(groupName) {
                const confirmResult = await Swal.fire({
                    title: '{{ __('cv.confirm_delete_group_title') }}',
                    text: `{{ __('cv.confirm_delete_group_text', ['name' => '${groupName}']) }}`.replace(':name', groupName), // Client side replace if needed or just use JS template string structure if we change translation to JS safe
                    // Ideally we should handle the dynamic part carefully. Let's use a simple replace approach.
                    // But wait, Blade renders on server. So '${groupName}' is JS.
                    // Better: text: "{{ __('cv.confirm_delete_group_text', ['name' => 'PLACEHOLDER']) }}".replace('PLACEHOLDER', groupName),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('cv.confirm_delete_yes') }}',
                    cancelButtonText: '{{ __('cv.confirm_delete_cancel') }}',
                    reverseButtons: true,
                });

                if (!confirmResult.isConfirmed) return;

                $.post("{{ route('profile.delete.skill-group') }}", {
                    group: groupName,
                    _method: 'DELETE'
                }, function(response) {
                    $('#container-profile').html(response);
                });
            }
        </script>
    @endpush
@endsection

@push('styles')
    @include('common.css.custom')
@endpush
