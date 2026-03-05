<section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-12" id="projects">
    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class=" text-xl font-bold">{{ __('cv.projects') }}</h2>
        <i class="bi bi-folder-fill text-xl"></i>
    </div>
    <div class="p-4 flex flex-col min-h-[100px]">
        <div class="flex flex-col gap-2 mb-6 {{ $profile->projects->count() < 1 ? 'hidden' : '' }}" id="projects-container">
            @if($profile->projects->count() > 0)
            @php
            $projIndex = 0;
            @endphp
            @foreach($profile->projects as $proj)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-100 p-4 rounded-lg" id="project-container-{{ $projIndex }}">
                <input type="hidden" name="proj[{{ $projIndex }}][id]" value="{{ $proj->id }}">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.project_name') }}</label>
                    <input class="form-control text-muted" placeholder="AI Task Manager" value="{{ $proj->name ?? '' }}" type="text" name="proj[{{$projIndex}}][name]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.url') }}</label>
                    <input class="form-control text-muted" placeholder="https://github.com/..." value="{{ $proj->url ?? '' }}" type="url" name="proj[{{$projIndex}}][url]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.start_date') }}</label>
                    <input class="form-control text-muted input-datepicker-month" value="{{ $proj->start_date ? $proj->start_date->format('m-Y') : '' }}" type="text" autocomplete="off" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="proj[{{$projIndex}}][start_date]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.end_date') }}</label>
                    <input class="form-control text-muted input-datepicker-month" value="{{ $proj->end_date ? $proj->end_date->format('m-Y') : '' }}" type="text" autocomplete="off" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="proj[{{$projIndex}}][end_date]" />
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="proj[{{$projIndex}}][is_current]" {{ $proj->end_date ? '' : 'checked' }} value="1" id="project_current">
                        <label class="form-check-label" for="project_current">{{ __('cv.current_project') }}</label>
                    </div>
                    <div class="invalid-note"></div>
                </div>
                <div class="md:col-span-2 flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.description') }}</label>
                    <div id="proj-editor-{{ $projIndex }}"  class="quill-editor bg-white">
                        {!! $proj->description !!}
                    </div>
                    <input type="hidden" name="proj[{{ $projIndex }}][description]" id="proj-input-{{ $projIndex }}" value="{{ $proj->description }}">
                    <div class="invalid-note"></div>
                </div>
            </div>
            @php
            $projIndex++;
            @endphp 
            @endforeach
            @endif
        </div>
        <div class="mt-auto">
            <x-client.elements.button type="button" class="h-12 w-full flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" onclick="addElement('projects')">
                <i class="bi bi-plus-lg"></i><span>Add Project</span>
            </x-client.elements.button>
        </div>
    </div>
</section>