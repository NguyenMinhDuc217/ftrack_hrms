
    
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
                    <h3 class="section-title">{{ __('cv.education') }}</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('educationModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-education">
                    @include('cv.partials.education', ['educations' => $profile->educations])
                </div>
            </div>

            <!-- 3. WORK EXPERIENCE -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">{{ __('cv.work_experience') }}</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('experienceModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-experience">
                    @include('cv.partials.experience', ['experiences' => $profile->experiences])
                </div>
            </div>

            <!-- 4. SKILLS -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">{{ __('cv.skills') }}</h3>
                    <div class="dropdown">
                        <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="checkSkillType()" data-bs-toggle="dropdown"><i class="ti ti-circle-plus fs-3"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" id="btn-core-skill" href="javascript:0;" onclick="openSkillModal('Core')"><i class="ti ti-code me-2"></i> {{ __('cv.core_skills') }}</a></li>
                            <li><a class="dropdown-item" id="btn-soft-skill" href="javascript:0;" onclick="openSkillModal('Soft')"><i class="ti ti-message-2 me-2"></i> {{ __('cv.soft_skills') }}</a></li>
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
                    <h3 class="section-title">{{ __('cv.languages') }}</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('languageModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-language">
                    @include('cv.partials.language', ['languages' => $profile->languages])
                </div>
            </div>

            <!-- 6. PROJECTS -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">{{ __('cv.projects') }}</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('projectModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-project">
                    @include('cv.partials.project', ['projects' => $profile->projects])
                </div>
            </div>

            <!-- 7. CERTIFICATES -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">{{ __('cv.certificates') }}</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('certificateModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-certificate">
                    @include('cv.partials.certificate', ['certificates' => $profile->certificates])
                </div>
            </div>

            <!-- 8. AWARDS -->
            <div class="card card-section">
                <div class="section-header">
                    <h3 class="section-title">{{ __('cv.awards') }}</h3>
                    <button class="btn btn-lg btn-add p-0 text-primary border-0" onclick="openModal('awardModal')"><i class="ti ti-circle-plus fs-3"></i></button>
                </div>
                <div class="section-body" id="container-award">
                    @include('cv.partials.award', ['awards' => $profile->awards])
                </div>
            </div>

        </div>
    </div>
</div>