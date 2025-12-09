<style>
    .card-section {
        /* border: none; */
    }
    .img-fluid {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>

<div class="card card-section" id="summary-view">
    <div class="section-body">
        <div class="d-flex justify-content-between pb-2">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/profile/blank-profile.svg') }}" alt="Profile Image" class="img-fluid">
                <div class="ps-4">
                    <h1 class="text-black fs-3 fw-bold mb-2">{{ $profile->full_name ?? 'User Name' }}</h1>
                    <h4 class="text-secondary fw-bold mb-3">{{ $profile->title ?? 'Title not set' }}</h4>
                </div>
            </div>
            <div class="h-100 d-flex align-items-top">
                <button class="btn btn-lg p-0 text-primary border-0" id="btn-edit-summary" onclick="openModal('summaryModal')"><i class="ti ti-edit fs-3 d-relative top-0"></i></button>
            </div>
        </div>
        <hr>
        {{-- basic information: email, phone date ò birth, gender, short addres --}}
        <div class="row pt-2 pb-2">
            <div class="col-md-6">
                <div class="d-flex gap-2 pb-2">
                    <p class="align-items-center"><i class="ti ti-mail text-rich-grey"></i></p>
                    <p class="text-truncated ims-2 text-rich-grey">{{ $user->email ?? 'Email not set' }}</p>
                </div>
                <div class="d-flex gap-2 pb-2">
                    <p class="align-items-center"><i class="ti ti-phone text-rich-grey"></i></p>
                    <p class="text-truncated ims-2 text-rich-grey">{{ $profile->phone_number ?? 'Phone not set' }}</p>
                </div>
                <div class="d-flex gap-2 pb-2">
                    <p class="align-items-center"><i class="ti ti-calendar text-rich-grey"></i></p>
                    <p class="text-truncated ims-2 text-rich-grey">{{ $user->date_of_birth ?? 'Date of birth not set' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2 pb-2">
                    <p class="align-items-center"><i class="ti ti-friends text-rich-grey"></i></p>
                    <p class="text-truncated ims-2 text-rich-grey text-capitalize">{{ $profile->gender->getLabel()['lang'] ?? 'Gender not set' }}</p>
                </div>
                <div class="d-flex gap-2 pb-2">
                    <p class="align-items-center"><i class="ti ti-map text-rich-grey"></i></p>
                    <p class="text-truncated ims-2 text-rich-grey">{{ (app()->getLocale() == 'en' ? $profile->province_name_en : $profile->province_name) ?? 'Address not set' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-section bg-">
    <div class="section-header">
        <h3 class="section-title">Summary</h3>
    </div>
    <div class="section-body" id="container-summary">
        <p class="text-muted">{{ $profile->summary ?? 'No summary added yet.' }}</p>
    </div>
</div>

@include('cv.modal.summary', ['profile' => $profile, 'user' => $user, 'genders' => $genders, 'provinces' => $provinces])
