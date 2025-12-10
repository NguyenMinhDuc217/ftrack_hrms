<!-- Project Modal -->
<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.project') }}" data-container="#container-project">
            <div class="modal-header"><h5 class="modal-title">Project</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">Project Name</label><input type="text" class="form-control" name="name" required>
                    <div class="invalid-note"></div>
                </div>
                <div class="mb-3"><label class="form-label">URL</label><input type="url" class="form-control" name="url">
                    <div class="invalid-note"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">Start Date</label><input type="text" class="form-control input-datepicker-month" name="start_date"><div class="invalid-note"></div></div>
                    <div class="col-md-6 mb-3"><label class="form-label">End Date</label><input type="text" class="form-control input-datepicker-month" name="end_date"><div class="invalid-note"></div></div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_current" value="1" id="project_current">
                    <label class="form-check-label" for="project_current">I'm currently working here</label>
                </div>
                <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="3"></textarea><div class="invalid-note"></div></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-danger">Save</button></div>
        </form>
    </div>
</div>
