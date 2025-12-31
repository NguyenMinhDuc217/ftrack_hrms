<!-- Language Modal -->
<div class="modal fade" id="languageModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content ajax-form" data-route="{{ route('profile.save.language') }}" data-container="#container-language">
            <div class="modal-header"><h5 class="modal-title">{{ __('cv.language') }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="mb-3"><label class="form-label">{{ __('cv.language') }}</label><input type="text" class="form-control" name="language" placeholder="{{ __('cv.placeholder_language') }}" required>
                    <div class="invalid-note"></div>
                </div>
                
                <div class="mb-3"><label class="form-label">{{ __('cv.proficiency') }}</label>
                    <select class="form-select" name="level">
                        <option value="Native">{{ __('cv.native') }}</option>
                        <option value="Fluent">{{ __('cv.fluent') }}</option>
                        <option value="Intermediate">{{ __('cv.intermediate') }}</option>
                        <option value="Basic">{{ __('cv.basic') }}</option>
                    </select>
                    <div class="invalid-note"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('cv.close') }}</button><button type="submit" class="btn btn-success">{{ __('cv.save_changes') }}</button></div>
        </form>
    </div>
</div>