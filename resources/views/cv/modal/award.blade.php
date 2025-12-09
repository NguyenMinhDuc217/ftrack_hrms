<!-- Award Modal -->
<div class="modal fade" id="awardModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.award') }}" data-container="#container-award">
            <div class="modal-header"><h5 class="modal-title">Award</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">Award Name</label><input type="text" class="form-control" name="name" required><div class="invalid-note"></div></div>
                <div class="mb-3"><label class="form-label">Organization</label><input type="text" class="form-control" name="organization"><div class="invalid-note"></div></div>
                <div class="mb-3"><label class="form-label">Year</label><input type="text" class="form-control input-datepicker-year" name="year"><div class="invalid-note"></div></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="2"></textarea><div class="invalid-note"></div></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-danger">Save</button></div>
        </form>
    </div>
</div>