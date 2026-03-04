<!-- Certificate Modal -->
<div class="modal fade" id="certificateModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.certificate') }}" data-container="#container-certificate">
            <div class="modal-header"><h5 class="modal-title">{{ __('cv.certificate') }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">{{ __('cv.certificate_name') }}</label><input type="text" class="form-control" name="name" required><div class="invalid-note"></div></div>
                <div class="mb-3"><label class="form-label">{{ __('cv.organization') }}</label><input type="text" class="form-control" name="organization"><div class="invalid-note"></div></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">{{ __('cv.issue_date') }}</label><input type="text" class="form-control input-datepicker-month" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="issue_date"><div class="invalid-note"></div></div>
                    <div class="col-md-6 mb-3"><label class="form-label">{{ __('cv.expiration_date') }}</label><input type="text" class="form-control input-datepicker-month" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="expiration_date"><div class="invalid-note"></div></div>
                </div>
                <div class="mb-3"><label class="form-label">{{ __('cv.url') }}</label><input type="url" class="form-control" name="url"><div class="invalid-note"></div></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('cv.close') }}</button><button type="submit" class="btn btn-success">{{ __('cv.save_changes') }}</button></div>
        </form>
    </div>
</div>
