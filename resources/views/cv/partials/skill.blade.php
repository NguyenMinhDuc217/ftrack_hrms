@php
    // Group skills by 'group' field
    // We treat 'Soft Skill' (exact match) as special.
    // All others are "Core" groups.
    $groupedSkills = collect($skills)->groupBy('group');
    $softSkills = $groupedSkills->get('Soft Skill') ?? collect();
    $coreGroups = $groupedSkills->except(['Soft Skill']);
@endphp

<!-- Header with + Button -->
{{-- In the index.blade.php, the header is already there. But we need to update the Add button logic there or here. 
     The user asked to "allow to choose type of skill". 
     We can assume the + button in the parent view calls a function or we add a dropdown here. 
     Wait, the parent view has the + button. I should update index.blade.php for the + button dropdown. 
     Let's focus on the LIST here.
--}}

@if($skills->isEmpty()) <p class="text-muted">No skills added.</p> @endif

<!-- Core Skills Groups -->
@foreach($coreGroups as $groupName => $groupSkills)
    <div class="mb-4" id="skillGroup-{{ $groupName }}">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="fw-bold mb-0">{{ $groupName }}</h6>
            <div class="d-flex gap-2">
                <i class="ti ti-pencil action-btn edit-btn fs-5" onclick='openSkillModal("Core", @json($groupName), @json($groupSkills))'></i>
                <i class="ti ti-trash action-btn delete-btn fs-5 text-danger" onclick="deleteSkillGroup('{{ $groupName }}')"></i>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 pb-2">
            @foreach($groupSkills as $skill)
            <span class="badge bg-light text-dark border p-2 rounded-pill">
                <strong>{{ $skill->name }}</strong>
                @if($skill->year_of_experience) <span class="text-muted ms-1">({{ $skill->year_of_experience }} years)</span> @endif
            </span>
            @endforeach
        </div>
        <hr class="text-muted opacity-25">
    </div>
@endforeach

<!-- Soft Skills -->
@if($softSkills->isNotEmpty())
    <div class="mb-3" id="skillGroup-soft">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="fw-bold mb-0">Soft Skills</h6>
            <div class="d-flex gap-2">
                <i class="ti ti-edit fs-5 action-btn" onclick='openSkillModal("Soft", "Soft Skill", @json($softSkills))'></i>
                {{-- Soft skills group usually isn't deleted entirely via button if it's "fixed", but we can allow clearing it --}}
                 <i class="ti ti-trash fs-5 action-btn text-danger" onclick="deleteSkillGroup('Soft Skill')"></i>
            </div>
        </div>
        <ul class="list-unstyled mb-0 ps-3 ">
            @foreach($softSkills as $skill)
            <li class="mb-1" style="list-style-type: disclosure-closed;">{{ $skill->name }}</li>
            @endforeach
        </ul>
    </div>
@endif