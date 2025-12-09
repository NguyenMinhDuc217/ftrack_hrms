<!-- ================= NEW SUMMARY MODAL ================= -->
<div class="modal fade" id="summaryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.summary') }}" data-container="#container-summary">
            <div class="modal-header">
                <h5 class="modal-title text-bold">Edit Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Full Name -->
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="full_name" value="{{ $profile->full_name ?? '' }}" required>
                        <div class="invalid-note"></div>
                    </div>
                    <!-- Gender -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <select class="form-select" name="gender" required>
                            <option value="">Select...</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->value }}" {{ !empty($profile->gender) && $profile->gender->value == $gender->value ? 'selected' : '' }}>{{ $gender->getLabel()['lang'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-note"></div>
                    </div>
                </div>

                <!-- Professional Title -->
                <div class="row mb-3">
                    <div class="col-md-8 mb-3"> 
                        <label class="form-label">Professional Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ $profile->title ?? '' }}" required placeholder="e.g. Senior PHP Developer">
                        <div class="invalid-note"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="text" class="form-control input-datepicker" name="date_of_birth" value="{{ !empty($user->date_of_birth) ? date('Y-m-d', strtotime($user->date_of_birth)) : '' }}">
                        <div class="invalid-note"></div>
                    </div>
                </div>

                <div class="row">
                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" pattern="^[0-9]{10}" required title="Phone number must be 10 digits" value="{{ $profile->phone_number ?? '' }}">
                        <div class="invalid-note"></div>
                    </div>
                    <!-- Province -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Province <span class="text-danger">*</span></label>
                        <select class="form-select" name="province_code" required>
                            <option value="">Select Province...</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->code }}" {{ !empty($profile->province_code) && $profile->province_code == $prov->code ? 'selected' : '' }}>{{ $prov->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-note"></div>
                    </div>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $profile->address ?? '' }}" placeholder="House number, Street name...">
                    <div class="invalid-note"></div>
                </div>

                <!-- Summary -->
                <div class="mb-3">
                    <label class="form-label">Professional Summary</label>
                    <textarea class="form-control" name="summary" rows="5" placeholder="Briefly describe your experience and skills...">{{ $profile->summary ?? '' }}</textarea>
                    <div class="invalid-note"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Save Changes</button>
            </div>
        </form>
    </div>
</div>