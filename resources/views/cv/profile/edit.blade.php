@extends('layouts.client')

@section('title', __('cv.manage_cvs'))

@section('content')

<section class="bg-background ">
    <style>
        .ql-editor {
            height: 100px;
            overflow-y: auto;
        }
    </style>
    <div class="container px-0 mx-0">

        <!-- Top Navigation Bar -->
        <div class="fixed left-0 right-0 mx-auto max-w-[1340px] top-[88px] z-50 bg-white rounded-b-lg border-b-[2px] border-gray-100 px-4 md:px-6 py-3">
            <div class="flex items-center justify-between whitespace-nowrap">
                <div class="flex items-center gap-4">
                    <div class="">
                        <i class="bi bi-file-earmark-person text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <h2 class=" text-xl font-bold leading-tight tracking-[-0.015em]">Detailed CV Information</h2>
                        <p class="text-[#9c7349] dark:text-[#cbb094] text-base font-normal leading-normal">Craft your career story. Fill in the sections below to generate a modern, professional resume.</p>
                    </div>
                </div>
                <div class="flex flex-1 justify-end gap-4 md:gap-8">
                    <x-client.elements.button type="button" class="min-w-[100px] cursor-pointer flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" id="save-profile">
                        <span class="truncate">Save CV</span>
                    </x-client.elements.button>
                </div>
            </div>
        </div>

        <div class="mx-auto flex py-4 gap-8 !pt-[100px]">
            <!-- Sidebar Navigation -->
            <aside class="hidden lg:flex flex-col w-64 shrink-0 gap-4 sticky top-24 h-fit">
                <nav class="flex flex-col card rounded-lg shadow-sm border border-gray-100">
                    <a class="flex items-center gap-3  rounded-lg p-4 py-3 sidebar-active bg-gray-200 transition-colors" href="#personal">
                        <i class="bi bi-person"></i>
                        <p class=" text-sm font-semibold leading-normal">Personal Information</p>
                    </a>
                    <a class="flex items-center gap-3  rounded-lg p-4 py-3 hover:bg-gray-100 transition-colors" href="#skills">
                        <i class="bi bi-lightning-charge"></i>
                        <p class=" text-sm font-medium leading-normal">Skills</p>
                    </a>
                    <a class="flex items-center gap-3  rounded-lg p-4 py-3 hover:bg-gray-100 transition-colors" href="#experience">
                        <i class="bi bi-briefcase"></i>
                        <p class=" text-sm font-medium leading-normal">Work Experience</p>
                    </a>
                    <a class="flex items-center gap-3  rounded-lg p-4 py-3 hover:bg-gray-100 transition-colors" href="#education">
                        <i class="bi bi-mortarboard"></i>
                        <p class=" text-sm font-medium leading-normal">Education</p>
                    </a>
                    <a class="flex items-center gap-3  rounded-lg p-4 py-3 hover:bg-gray-100 transition-colors" href="#projects">
                        <i class="bi bi-folder2-open"></i>
                        <p class=" text-sm font-medium leading-normal">Projects</p>
                    </a>
                </nav>
                <div class="mt-8 p-4 bg-[var(--accent-color)]/10 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-[var(--accent-color)] uppercase tracking-wider mb-1">Status</p>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                        <div class="bg-[var(--accent-color)] h-2 rounded-full" style="width: {{ $completionPercentage }}%"></div>
                    </div>
                    <p class="text-xs text-[#9c7349] dark:text-[#cbb094]">{{ $completionPercentage }}% Completed</p>
                </div>
            </aside>

            <main class="flex-1 flex flex-col gap-10">
                <form class="flex flex-col gap-4" id="profile-form">
                    <!-- Section: Personal Information -->
                    @include('cv.profile.partials.summary')

                    <!-- Section: Skills -->
                    @include('cv.profile.partials.skill')

                    <!-- Section: Work Experience -->
                    @include('cv.profile.partials.experience')

                    <!-- Section: Education -->
                    @include('cv.profile.partials.education')

                    <!-- Section: Projects -->
                    @include('cv.profile.partials.project')
                </form>
            </main>
        </div>

        <div class="lg:hidden fixed bottom-0 left-0 w-full bg-white dark:bg-background-dark border-t border-[#f4ede7] p-4 flex gap-3 z-50">
            <button class="flex-1 bg-[var(--accent-color)] text-white font-bold py-3 rounded-lg shadow-lg">Save CV</button>
            <button class="flex-1 bg-[#f4ede7] dark:bg-[#3d2f21] font-bold py-3 rounded-lg">Preview</button>
        </div>
       
    </div>
</section>

<script>
    function addElement(type, $iGroup = null) {
        event.preventDefault();
        if ($iGroup == null) {
            $iGroup = $('#group_skills').children().length;
        }
        switch (type) {
            case 'group_skills':
                var $iSkill = $('#skill-container').children().length;
                var html = `
                    <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                        <div class="flex flex-col md:flex-row gap-4 mb-2 pb-2 border-b-2">
                            <div class="flex-1">
                                <label class="form-label">{{ __('cv.group_name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-muted" name="skill[${$iGroup}][group]" value="" placeholder="e.g. Backend, Frontend">
                                <div class="invalid-note"></div>
                            </div>
                            <div class="w-10"></div>
                        </div>
                        <div class="space-y-3" id="skill-container-${$iGroup}">
                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="flex-1">
                                    <input type="text" class="form-control text-muted" id="newSkillName" name="skill[${$iGroup}][skills][${$iSkill}][newSkillName]" placeholder="{{ __('cv.placeholder_skill') }}" value="">
                                    <div class="invalid-note"></div>
                                </div>
                                <div class="flex-1" id="newSkillExpContainer" style="width: 150px;">
                                    <select class="form-select" id="newSkillExp" name="skill[${$iGroup}][skills][${$iSkill}][newSkillExp]">
                                        <option value="">{{ __('cv.exp') }}</option>
                                        <option value="1">{{ __('cv.year_1') }}</option>
                                        <option value="2">{{ __('cv.year_2') }}</option>
                                        <option value="3">{{ __('cv.year_3') }}</option>
                                        <option value="4">{{ __('cv.year_4') }}</option>
                                        <option value="5">{{ __('cv.year_5_plus') }}</option>
                                        <option value="10">{{ __('cv.year_10_plus') }}</option>
                                    </select>
                                    <div class="invalid-note"></div>
                                </div>
                                <button type="button" class="p-2 text-red-500 hover:bg-red-50 rounded-lg shrink-0">
                                    <i class="bi bi-trash-fill text-xl"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="mt-4 flex items-center gap-2 text-[var(--accent-color)] font-bold text-sm" onclick="addElement('skill', ${$iGroup})">
                            <i class="bi bi-plus-circle-fill"></i>
                            Add Skill
                        </button>
                    </div>
                `;
                $('#group_skills').removeClass('hidden').append(html);
                break;
            case 'skill':
                var $iSkill = $('#skill-container-' + $iGroup).children().length;
                var html = `
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" class="form-control text-muted" id="newSkillName" name="skill[${$iGroup}][skills][${$iSkill}][newSkillName]" placeholder="{{ __('cv.placeholder_skill') }}" value="">
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex-1" id="newSkillExpContainer" style="width: 150px;">
                            <select class="form-select" id="newSkillExp" name="skill[${$iGroup}][skills][${$iSkill}][newSkillExp]">
                                <option value="">{{ __('cv.exp') }}</option>
                                <option value="1">{{ __('cv.year_1') }}</option>
                                <option value="2">{{ __('cv.year_2') }}</option>
                                <option value="3">{{ __('cv.year_3') }}</option>
                                <option value="4">{{ __('cv.year_4') }}</option>
                                <option value="5">{{ __('cv.year_5_plus') }}</option>
                                <option value="10">{{ __('cv.year_10_plus') }}</option>
                            </select>
                        </div>
                        <button type="button" class="p-2 text-red-500 hover:bg-red-50 rounded-lg shrink-0">
                            <i class="bi bi-trash-fill text-xl"></i>
                        </button>
                    </div>
                `;
                $('#skill-container-' + $iGroup).removeClass('hidden').append(html);
                break;
            case 'experiences':
                var $iExp = $('#experiences-container').children().length;
                var html = `
                    <div class="bg-gray-100 p-4 rounded-lg border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4 relative" id="experience-container-${$iExp}">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ Str::upper(__('cv.position')) }}</label>
                            <input class="form-control text-muted" placeholder="Lead UI Designer" name="exp[${$iExp}][position]" type="text" value="" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">Company Name</label>
                            <input class="form-control text-muted" placeholder="TechFlow Inc." name="exp[${$iExp}][company_name]" type="text" value="" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.start_date') }}</label>
                            <input class="form-control text-muted" value="" type="month" name="exp[${$iExp}][start_date]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.end_date') }}</label>
                            <div class="flex flex-col gap-2">
                                <input class="form-control text-muted" value="" type="month" name="exp[${$iExp}][end_date]" />
                                <label class="inline-flex items-center mt-1">
                                    <input class="rounded border-[#f4ede7] text-[var(--accent-color)] focus:ring-[var(--accent-color)]" type="checkbox" value="1" name="exp[${$iExp}][is_current]" />
                                    <span class="ml-2 text-xs text-[#9c7349]">Currently working here</span>
                                </label>
                                <div class="invalid-note"></div>
                            </div>
                        </div>
                        <div class="md:col-span-2 flex flex-col">
                            <label class="form-label text-sm font-bold">Job Description</label>
                            <div id="exp-editor-${$iExp}" class="quill-editor bg-white"></div>
                            <input type="hidden" name="exp[${$iExp}][description]" id="exp-input-${$iExp}">
                            <div class="invalid-note"></div>
                        </div>
                    </div>
                `;
                $('#experiences-container').removeClass('hidden').append(html);
                initQuillEditor(`#exp-editor-${$iExp}`, `#exp-input-${$iExp}`);
                break;
            case 'educations':
                var $iEdu = $('#educations-container').children().length;
                var html = `
                    <div class="bg-gray-100 p-4 rounded-lg border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4" id="education-container-${$iEdu}">
                        <div class="md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.school') }}</label>
                            <input class="form-control text-muted" placeholder="Stanford University" value="" type="text" name="edu[${$iEdu}][school]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.degree') }}</label>
                            <input class="form-control text-muted" placeholder="Bachelor of Science" value="" type="text" name="edu[${$iEdu}][degree]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.major') }}</label>
                            <input class="form-control text-muted" placeholder="Computer Science" value="" type="text" name="edu[${$iEdu}][major]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">Start Date</label>
                            <input class="form-control text-muted" value="" type="month" name="edu[${$iEdu}][start_date]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">End Date (or Expected)</label>
                            <input class="form-control text-muted" value="" type="month" name="edu[${$iEdu}][end_date]" />
                             <label class="inline-flex items-center mt-1">
                                <input class="rounded border-[#f4ede7] text-[var(--accent-color)] focus:ring-[var(--accent-color)]" type="checkbox" name="edu[${$iEdu}][is_current]" value="1"/>
                                <span class="ml-2 text-xs text-[#9c7349]">Currently working here</span>
                            </label>
                            <div class="invalid-note"></div>
                        </div>
                    </div>
                `;
                $('#educations-container').removeClass('hidden').append(html);
                break;
            case 'projects':
                var $iProject = $('#projects-container').children().length;
                var html = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-100 p-4 rounded-lg" id="project-container-${$iProject}">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.project_name') }}</label>
                            <input class="form-control text-muted" placeholder="AI Task Manager" value="" type="text" name="proj[${$iProject}][name]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.url') }}</label>
                            <input class="form-control text-muted" placeholder="https://github.com/..." value="" type="url" name="proj[${$iProject}][url]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.start_date') }}</label>
                            <input class="form-control text-muted" value="" type="month" name="proj[${$iProject}][start_date]" />
                            <div class="invalid-note"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">{{ __('cv.end_date') }}</label>
                            <input class="form-control text-muted" value="" type="month" name="proj[${$iProject}][end_date]" />
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" name="proj[${$iProject}][is_current]" value="1" id="project_current">
                                <label class="form-check-label" for="project_current">{{ __('cv.current_project') }}</label>
                            </div>
                            <div class="invalid-note"></div>
                        </div>
                        <div class="md:col-span-2 flex flex-col"> 
                            <label class="form-label text-sm font-bold">{{ __('cv.description') }}</label>
                            <div id="proj-editor-${$iProject}" class="quill-editor bg-white"></div>
                            <input type="hidden" name="proj[${$iProject}][description]" id="proj-input-${$iProject}">
                            <div class="invalid-note"></div>
                        </div>
                    </div>
                `;
                $('#projects-container').removeClass('hidden').append(html);
                initQuillEditor(`#proj-editor-${$iProject}`, `#proj-input-${$iProject}`);
                break;
            default:
                break;
        }
    }

    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link', 'image', 'video', 'formula'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];

    function initQuillEditor(editorSelector, inputSelector) {
        if ($(editorSelector).length === 0) return;

        const quill = new Quill(editorSelector, {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            },
        });

        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            if (html === '<p><br></p>') html = ''; // Xử lý editor trống
            $(inputSelector).val(html);
        });

        return quill;
    }

    // Khởi tạo cho toàn bộ editor có sẵn khi load trang
    $(document).ready(function() {
        $('.quill-editor').each(function() {
            var editorId = $(this).attr('id');
            var inputId = editorId.replace('editor', 'input');
            
            // Khởi tạo và lấy instance Quill
            const quillInstance = initQuillEditor('#' + editorId, '#' + inputId);

            // Chỉ áp dụng placeholder cho summary
            if (editorId === 'info-editor' && quillInstance) {
                quillInstance.root.setAttribute('data-placeholder', "{{ __('cv.placeholder_summary') }}");
            }
        });
    });

    $('#save-profile').click(function(){
        var form = $("#profile-form");
        var formData = new FormData(form[0]);
        console.log(formData);
        $.ajax({
            url: "{{ route('profile.save.all') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('.invalid-note').empty().removeClass('text-danger');
                    Toast.fire({
                            icon: 'success',
                            title: response.message
                        }).then(() => {
                            if (response.redirect_to) {
                                window.location.href = response.redirect_to;
                            }
                        });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    console.log(errors)
                    $('.invalid-note').empty().removeClass('text-danger');
                    $.each(errors, function(key, message) {
                        const bracketName = dotToBracket(key);

                        let input = $('[name="' + bracketName + '"]');

                        // Nếu không tìm thấy (do nested sâu hoặc dynamic), thử prefix
                        if (input.length === 0) {
                            input = $('[name^="' + bracketName + '["]'); // cho các field con như skill[0][0][newSkillName]
                        }

                        if (input.length > 0) {
                            // Tìm .invalid-note gần nhất (tìm từ div cha gần nhất)
                            let note = input.closest('div')
                                        .find('.invalid-note')
                                        .first();  // lấy cái đầu tiên nếu có nhiều

                            if (note.length) {
                                note.html(message.join('<br>')).addClass('text-danger');
                            } else {
                                console.warn('Không tìm thấy .invalid-note cho field:', bracketName);
                            }
                        } else {
                            console.warn('Không tìm thấy input cho field:', bracketName);
                        }
                    });
                    // toastr.error('Vui lòng kiểm tra lại thông tin!');
                } else {
                    // toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
                }
            }
        })
    })

    function dotToBracket(dotKey) {
        const parts = dotKey.split('.');
        let result = parts[0];
        for (let i = 1; i < parts.length; i++) {
            result += '[' + parts[i] + ']';
        }
        return result;
    }
</script>

@endsection