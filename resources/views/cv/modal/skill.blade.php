<!-- Skill Modal (Bulk Edit) -->
<div class="modal fade" id="skillModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="skillGroupForm" onsubmit="saveSkillGroup(event)">
            <div class="modal-header">
                <h5 class="modal-title" id="skillModalTitle">{{ __('cv.manage_skills') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Hidden inputs -->
                <input type="hidden" name="old_group" id="skillOldGroup">
                <!-- Group Type: Core or Soft -->
                <input type="hidden" name="type" id="skillType"> 

                <!-- Group Name Input (Only for Core) -->
                <div class="mb-4" id="skillGroupNameContainer">
                    <label class="form-label">{{ __('cv.group_name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="group" id="skillGroupName" placeholder="e.g. Backend, Frontend">
                    <div class="invalid-feedback">{{ __('cv.group_name_required') }}</div>
                </div>

                <!-- Add New Skill Section -->
                <div class="card bg-light border-0 mb-3">
                    <div class="card-body p-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">{{ __('cv.add_skills') }}</label>
                        <div class="d-flex gap-2">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control" id="newSkillName" placeholder="{{ __('cv.placeholder_skill') }}">
                            </div>
                            <div class="" id="newSkillExpContainer" style="width: 150px;">
                                <select class="form-select" id="newSkillExp">
                                    <option value="">{{ __('cv.exp') }}</option>
                                    <option value="1">{{ __('cv.year_1') }}</option>
                                    <option value="2">{{ __('cv.year_2') }}</option>
                                    <option value="3">{{ __('cv.year_3') }}</option>
                                    <option value="4">{{ __('cv.year_4') }}</option>
                                    <option value="5">{{ __('cv.year_5_plus') }}</option>
                                    <option value="10">{{ __('cv.year_10_plus') }}</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-dark" onclick="addSkillToList()"><i class="ti ti-plus"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Skill List -->
                <div>
                    <label class="form-label">{{ __('cv.skills_list') }} (<span id="skillCount">0</span>)</label>
                    <div id="skillListContainer" class="d-flex flex-wrap gap-2">
                        <!-- Skills will be rendered here as badges -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('cv.close') }}</button>
                <button type="submit" class="btn btn-success">{{ __('cv.save_group') }}</button>
            </div>
        </form>
    </div>
</div>