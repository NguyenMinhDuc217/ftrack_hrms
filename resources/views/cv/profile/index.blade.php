@extends('layouts.client')

@section('title', 'CV Profile')

@section('content')

    
<style>
    .card-section {
        border: none;
        border-radius: 8px;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
        background: #fff;
    }

    .section-header {
        border-bottom: 1px solid #f0f0f0;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        color: #333;
        padding: 0.75rem;
    }

    .section-body {
        padding: 1rem;
    }

    /* .btn-add {
        color: #dc3545;
        border: 1px dashed ;
        background: transparent;
    }

    .btn-add:hover {
        background: #fff0f1;
        color: #dc3545;
        border: 1px dashed ;
    } */

    .action-btn {
        cursor: pointer;
        color: #6c757d;
        transition: 0.2s;
    }

    .action-btn:hover {
        color: #000;
    }

    .edit-btn:hover {
        color: #0d6efd;
    }

    .delete-btn:hover {
        color: #dc3545;
    }

    .invalid-note {
        color: #dc3545;
        font-size: 0.8rem;
    }
</style>

<div class="container pt-1">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- 1. SUMMARY -->
            <div id="container-summary">
                @include('cv.partials.summary', ['profile' => $profile, 'genders' => $genders])
            </div>

            <!-- 2. EDUCATION -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Education</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('educationModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-education">
                    @include('cv.partials.education', ['educations' => $profile->educations])
                </div>
            </div>

            <!-- 3. WORK EXPERIENCE -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Work Experience</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('experienceModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-experience">
                    @include('cv.partials.experience', ['experiences' => $profile->experiences])
                </div>
            </div>

            <!-- 4. SKILLS -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Skills</h3>
                    <div class="dropdown">
                        <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="checkSkillType()" data-bs-toggle="dropdown"><i class="ti ti-circle-plus fs-3"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" id="btn-core-skill" href="javascript:0;" onclick="openSkillModal('Core')"><i class="ti ti-code me-2"></i> Core skills</a></li>
                            <li><a class="dropdown-item" id="btn-soft-skill" href="javascript:0;" onclick="openSkillModal('Soft')"><i class="ti ti-message-2 me-2"></i> Soft skills</a></li>
                        </ul>
                    </div>
                </div>
                <div class="section-body" id="container-skill">
                    @include('cv.partials.skill', ['skills' => $profile->skills])
                </div>
            </div>

             <!-- 5. LANGUAGES -->
             <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Languages</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('languageModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-language">
                    @include('cv.partials.language', ['languages' => $profile->languages])
                </div>
            </div>

            <!-- 6. PROJECTS -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Projects</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('projectModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-project">
                    @include('cv.partials.project', ['projects' => $profile->projects])
                </div>
            </div>

            <!-- 7. CERTIFICATES -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Certificates</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('certificateModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-certificate">
                    @include('cv.partials.certificate', ['certificates' => $profile->certificates])
                </div>
            </div>

            <!-- 8. AWARDS -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">Awards</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('awardModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-award">
                    @include('cv.partials.award', ['awards' => $profile->awards])
                </div>
            </div>

        </div>
    </div>
</div>



<!-- ================= MODALS ================= -->

@include('cv.modal.education')
@include('cv.modal.experience')
@include('cv.modal.language')
@include('cv.modal.skill')
@include('cv.modal.award')
@include('cv.modal.certificate')
@include('cv.modal.project')









<!-- JS -->

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
        let container = $form.data('container');
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
            }).fail(function() { alert('Error saving data.'); });
        }
    });

    // 3. Generic Delete Handler
    window.deleteItem = async function(url, container) {
        const confirmResult = await Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
        });
        if (!confirmResult.isConfirmed) return;
        $.ajax({
            url: url, type: 'DELETE',
            success: function(response) { $(container).html(response); },
            error: function() { alert('Error deleting item.'); }
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
            $('#skillModalTitle').text('Soft Skills');
            $('#skillGroupNameContainer').hide();
            $('#skillGroupName').val('Soft Skill'); // Fixed name
            $('#newSkillExpContainer').hide(); // No exp for soft skills
        } else {
            $('#skillModalTitle').text(groupName ? 'Edit Core Skills' : 'Add Core Skills Group');
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
            alert('Group name is required');
            return;
        }

        $.post("{{ route('profile.save.skill-group') }}", {
            group: groupName,
            old_group: $('#skillOldGroup').val(),
            skills: currentSkills,
        }, function(response) {
            skillModal.hide();
            delete skillModal;
            $('#container-skill').html(response);
        }).fail(function() {
            alert('Error saving skills.');
        });
    };

    // Delete Group Handler
    window.deleteSkillGroup = async function(groupName) {
        const confirmResult = await Swal.fire({
            title: 'Delete Group?',
            text: `Delete "${groupName}" and all its skills?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
        });

        if (!confirmResult.isConfirmed) return;

        $.post("{{ route('profile.delete.skill-group') }}", {
            group: groupName,
            _method: 'DELETE'
        }, function(response) {
            $('#container-skill').html(response);
        });
    }
</script>
@endpush

@endsection
@push('styles')
    @include('common.css.custom')
@endpush
