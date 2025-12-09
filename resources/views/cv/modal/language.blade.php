<!-- Language Modal -->
<div class="modal fade" id="languageModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.language') }}" data-container="#container-language">
            <div class="modal-header"><h5 class="modal-title">Language</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">Language</label><input type="text" class="form-control" name="language" required>
                    <div class="invalid-note"></div>
                </div>
                
                <div class="mb-3"><label class="form-label">Proficiency</label>
                    <select class="form-select" name="level">
                        <option value="Native">Native</option>
                        <option value="Fluent">Fluent</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Basic">Basic</option>
                    </select>
                    <div class="invalid-note"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-danger">Save</button></div>
        </form>
    </div>
</div>