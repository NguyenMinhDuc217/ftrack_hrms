<!-- Experience Modal -->
<div class="modal fade" id="experienceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.experience') }}" data-container="#container-experience">
            <div class="modal-header">
                <h5 class="modal-title">Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3">
                    <label class="form-label">Position <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="position" required>
                    <div class="invalid-note"></div>    
                </div>
                <div class="mb-3">
                    <label class="form-label">Company <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_name" required>
                    <div class="invalid-note"></div>
                </div>
                {{-- convert start date/end date to select month and year --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="text" class="form-control input-datepicker-month" autocomplete="off" name="start_date" id="exp_start_date">
                        <div class="invalid-note"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="text" class="form-control input-datepicker-month" autocomplete="off" name="end_date" id="exp_end_date">
                        <div class="invalid-note"></div>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_current" value="1" id="exp_current">
                    <label class="form-check-label" for="exp_current">I currently work here</label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="4"></textarea>
                    <div class="invalid-note"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Save Experience</button>
            </div>
        </form>
    </div>
</div>