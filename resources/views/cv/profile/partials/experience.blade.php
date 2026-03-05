<section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden" id="experience">
    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class=" text-xl font-bold">{{ __('cv.work_experience') }}</h2>
        <i class="bi bi-briefcase-fill text-xl"></i>
    </div>
    <div class="p-4 flex flex-col min-h-[100px]">
        <div class="flex flex-col gap-2 mb-6 {{ $profile->experiences->count() < 1 ? 'hidden' : '' }}" id="experiences-container">
            @if($profile->experiences->count() > 0)
            @php
            $expIndex = 0;
            @endphp
            @foreach($profile->experiences as $exp)
            <div class="bg-gray-100 p-4 rounded-lg border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4 relative"
                id="experience-container-{{ $expIndex }}">
                <input type="hidden" name="exp[{{ $expIndex }}][id]" value="{{ $exp->id }}">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ Str::upper(__('cv.position')) }}</label>
                    <input class="form-control text-muted" placeholder="Lead UI Designer" name="exp[{{$expIndex}}][position]" type="text" value="{{ $exp->position }}" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">Company Name</label>
                    <input class="form-control text-muted" placeholder="TechFlow Inc." name="exp[{{$expIndex}}][company_name]" type="text" value="{{ $exp->company_name }}" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.start_date') }}</label>
                    <input class="form-control text-muted input-datepicker-month" value="{{ $exp->start_date->format('m-Y') }}" type="text" autocomplete="off" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="exp[{{$expIndex}}][start_date]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.end_date') }}</label>
                    <div class="flex flex-col gap-2">
                        <input class="form-control text-muted input-datepicker-month" value="{{ $exp->end_date ? $exp->end_date->format('m-Y') : '' }}" type="text" autocomplete="off" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="exp[{{$expIndex}}][end_date]" />
                        <label class="inline-flex items-center mt-1">
                            <input class="rounded border-[#f4ede7] text-[var(--accent-color)] focus:ring-[var(--accent-color)]" {{ $exp->end_date ? '' : 'checked' }} type="checkbox" name="exp[{{$expIndex}}][is_current]" value="1"/>
                            <span class="ml-2 text-xs text-[#9c7349]">Currently working here</span>
                        </label>
                        <div class="invalid-note"></div>
                    </div>
                </div>
                <div class="md:col-span-2 flex flex-col gap-2">
                    <label class="text-sm font-bold">Job Description</label>
                    <div id="exp-editor-{{ $expIndex }}"  class="quill-editor bg-white">
                        {!! $exp->description !!}
                    </div>
                    <input type="hidden" name="exp[{{ $expIndex }}][description]" id="exp-input-{{ $expIndex }}" value="{{ $exp->description }}">
                    <div class="invalid-note"></div>
                </div>
            </div>
            @php
            $expIndex++;
            @endphp
            @endforeach
            @endif
        </div>
        <div class="mt-auto">
            <x-client.elements.button type="button" class="h-12 w-full flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" onclick="addElement('experiences')">
                <i class="bi bi-plus-lg"></i><span> Add Work Experience</span>
            </x-client.elements.button>
        </div>
    </div>
</section>