<!-- Section: Skills -->
<section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden" id="skills">
    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class=" text-xl font-bold">{{ __('cv.manage_skills') }}</h2>
        <i class="bi bi-lightning-charge-fill text-xl"></i>
    </div>
    <div class="p-4 space-y-6" id="skills-container">
        <div class="flex flex-col gap-2" id="group_skills">
            @php
            $groupedSkills = collect($profile->skills)->groupBy('group');
            $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
            $coreGroups = $groupedSkills->except(['Soft Skill']);
            @endphp
            @if($coreGroups->count() < 1)
                <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                    <div class="flex flex-col md:flex-row gap-4 mb-2 pb-2 border-b-2">
                        <div class="flex-1">
                            <label class="form-label">{{ __('cv.group_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-muted" name="skill[0][group]" id="skillGroupName" placeholder="e.g. Backend, Frontend">
                            <div class="invalid-note"></div>
                        </div>
                        <div class="w-10"></div>
                    </div>
                    <div class="space-y-3" id="skill-container-0">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" class="form-control text-muted" name="skill[0][0][newSkillName]" id="newSkillName" placeholder="{{ __('cv.placeholder_skill') }}">
                                <div class="invalid-note"></div>
                            </div>
                            <div class="flex-1" id="newSkillExpContainer" style="width: 150px;">
                                <select class="form-select" id="newSkillExp" name="skill[0][0][newSkillExp]">
                                    <option value="">{{ __('cv.exp') }}</option>
                                    <option value="1">{{ __('cv.year_1') }}</option>
                                    <option value="2">{{ __('cv.year_2') }}</option>
                                    <option value="3">{{ __('cv.year_3') }}</option>
                                    <option value="4">{{ __('cv.year_4') }}</option>
                                    <option value="5">{{ __('cv.year_5_plus') }}</option>
                                    <option value="10">{{ __('cv.year_10_plus') }}</option>
                                </select>
                                <div class="invalid-note"></div>
                            </div>
                            <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg shrink-0">
                                <i class="bi bi-trash-fill text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="mt-4 flex items-center gap-2 text-[var(--accent-color)] font-bold text-sm" onclick="addElement('skill', 0)">
                        <i class="bi bi-plus-circle-fill"></i>
                        Add Skill
                    </button>
                </div>
            @else
                @php
                $index = 0;
                @endphp
                @foreach($coreGroups as $groupName => $groupSkills)
                <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                    <div class="flex flex-col md:flex-row gap-4 mb-2 pb-2 border-b-2">
                        <div class="flex-1">
                            <label class="form-label">{{ __('cv.group_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-muted" name="skill[{{$index}}][group]" value="{{ $groupName }}" placeholder="e.g. Backend, Frontend">
                            <div class="invalid-feedback">{{ __('cv.group_name_required') }}</div>
                        </div>
                        <div class="w-10"></div>
                    </div>
                    @if($groupSkills->count() > 0)
                    <div class="space-y-3" id="skill-container-{{$index}}">
                        @php
                        $skillIndex = 0;
                        @endphp
                        @foreach($groupSkills as $skill)
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" class="form-control text-muted" id="newSkillName" name="skill[{{$index}}][{{$skillIndex}}][newSkillName]" placeholder="{{ __('cv.placeholder_skill') }}" value="{{ $skill->name ?? '' }}">
                                <div class="invalid-note"></div>
                            </div>
                            <div class="flex-1" id="newSkillExpContainer" style="width: 150px;">
                                <select class="form-select" id="newSkillExp" name="skill[{{$index}}][{{$skillIndex}}][newSkillExp]">
                                    <option value="">{{ __('cv.exp') }}</option>
                                    <option value="1" {{ $skill->year_of_experience == 1 ? 'selected' : '' }}>{{ __('cv.year_1') }}</option>
                                    <option value="2" {{ $skill->year_of_experience == 2 ? 'selected' : '' }}>{{ __('cv.year_2') }}</option>
                                    <option value="3" {{ $skill->year_of_experience == 3 ? 'selected' : '' }}>{{ __('cv.year_3') }}</option>
                                    <option value="4" {{ $skill->year_of_experience == 4 ? 'selected' : '' }}>{{ __('cv.year_4') }}</option>
                                    <option value="5" {{ $skill->year_of_experience == 5 ? 'selected' : '' }}>{{ __('cv.year_5_plus') }}</option>
                                    <option value="10" {{ $skill->year_of_experience == 10 ? 'selected' : '' }}>{{ __('cv.year_10_plus') }}</option>
                                </select>
                            </div>
                            <button type="button" class="p-2 text-red-500 hover:bg-red-50 rounded-lg shrink-0">
                                <i class="bi bi-trash-fill text-xl"></i>
                            </button>
                        </div>
                        @php
                        $skillIndex++;
                        @endphp
                        @endforeach
                    </div>
                    @endif
                    <button type="button" class="mt-4 flex items-center gap-2 text-[var(--accent-color)] font-bold text-sm" onclick="addElement('skill', {{ $index }})">
                        <i class="bi bi-plus-circle-fill"></i>
                        Add Skill
                    </button>
                </div>
                @php
                $index++;
                @endphp
                @endforeach
            @endif
        </div>

        <button type="button" class="w-full py-3 border-2 border-dashed border-[var(--accent-color)] rounded-lg text-[var(--accent-color)] font-bold flex items-center justify-center gap-2 hover:bg-gray-100 transition-colors" onclick="addElement('group_skills')">
            <i class="bi bi-plus-lg"></i>
            Add New Skill Group
        </button>
    </div>
</section>