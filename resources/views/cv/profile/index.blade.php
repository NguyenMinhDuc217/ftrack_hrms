@extends('layouts.client')

@section('title', __('cv.profile'))

@section('content')

<style>
    :root {
        --bs-border-radius: 0;
    }
</style>
<div id="container-profile">
    
@include('cv.partials.profile', ['profile' => $profile])
</div>



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

                $('input[name="is_current"]').trigger('change');
                
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
                    confirmButtonText: '{{ __('cv.confirm') }}',
                    cancelButtonText: '{{ __('cv.cancel') }}',
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
                    confirmButtonText: '{{ __('cv.confirm') }}',
                    cancelButtonText: '{{ __('cv.cancel') }}',
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
