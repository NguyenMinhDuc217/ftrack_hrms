<!-- Education Modal -->
<div class="modal fade" id="educationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.education') }}" data-container="#container-education">
            <div class="modal-header"><h5 class="modal-title">{{ __('cv.education') }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">{{ __('cv.school') }}</label><input type="text" class="form-control" name="school" required><div class="invalid-note"></div></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">{{ __('cv.degree') }}</label><input type="text" class="form-control" name="degree" required><div class="invalid-note"></div></div>
                    <div class="col-md-6 mb-3"><label class="form-label">{{ __('cv.major') }}</label><input type="text" class="form-control" name="major" required><div class="invalid-note"></div></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('cv.start_date') }}</label>
                        <input type="text" class="form-control input-datepicker-month" autocomplete="off" name="start_date">
                        <div class="invalid-note"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('cv.end_date') }}</label>
                        <input type="text" class="form-control input-datepicker-month" autocomplete="off" name="end_date">
                        <div class="invalid-note"></div>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_current" value="1" id="edu_current">
                    <label class="form-check-label" for="edu_current">{{ __('cv.current_studying') }}</label>
                </div>
                <div class="mb-3"><label class="form-label">{{ __('cv.description') }}</label><textarea class="form-control" name="description" rows="3"></textarea><div class="invalid-note"></div></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('cv.close') }}</button><button type="submit" class="btn btn-danger">{{ __('cv.save_changes') }}</button></div>
        </form>
    </div>
</div>