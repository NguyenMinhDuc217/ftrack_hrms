<!-- Certificate Modal -->
<div class="modal fade" id="certificateModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.certificate') }}" data-container="#container-certificate">
            <div class="modal-header"><h5 class="modal-title">Certificate</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">Name</label><input type="text" class="form-control" name="name" required><div class="invalid-note"></div></div>
                <div class="mb-3"><label class="form-label">Organization</label><input type="text" class="form-control" name="organization"><div class="invalid-note"></div></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">Issue Date</label><input type="text" class="form-control input-datepicker-month" name="issue_date"><div class="invalid-note"></div></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Expiration Date</label><input type="text" class="form-control input-datepicker-month" name="expiration_date"><div class="invalid-note"></div></div>
                </div>
                <div class="mb-3"><label class="form-label">URL</label><input type="url" class="form-control" name="url"><div class="invalid-note"></div></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-danger">Save</button></div>
        </form>
    </div>
</div>
