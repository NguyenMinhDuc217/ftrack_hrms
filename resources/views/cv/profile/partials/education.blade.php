<section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden" id="education">
    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class=" text-xl font-bold">{{ __('cv.education') }}</h2>
        <i class="bi bi-mortarboard-fill text-xl"></i>
    </div>
    <div class="p-4 flex flex-col min-h-[100px]">
        <div class="flex flex-col gap-2 mb-6 {{ $profile->educations->count() < 1 ? 'hidden' : '' }}" id="educations-container">
            @if($profile->educations->count() > 0)
            @php
            $eduIndex = 0;
            @endphp
            @foreach($profile->educations as $edu)
            <div class="bg-gray-100 p-4 rounded-lg border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4" id="education-container-{{ $eduIndex }}">
                <input type="hidden" name="edu[{{ $eduIndex }}][id]" value="{{ $edu->id }}">
                <div class="md:col-span-2 flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.school') }}</label>
                    <input class="form-control text-muted" placeholder="Stanford University" value="{{ $edu->school }}" type="text" name="edu[{{$eduIndex}}][school]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.degree') }}</label>
                    <input class="form-control text-muted" placeholder="Bachelor of Science" value="{{ $edu->degree }}" type="text" name="edu[{{$eduIndex}}][degree]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ __('cv.major') }}</label>
                    <input class="form-control text-muted" placeholder="Computer Science" value="{{ $edu->major }}" type="text" name="edu[{{$eduIndex}}][major]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">Start Date</label>
                    <input class="form-control text-muted input-datepicker-month" value="{{ $edu->start_date->format('m-Y') }}" type="text" autocomplete="off" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="edu[{{$eduIndex}}][start_date]" />
                    <div class="invalid-note"></div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold">End Date (or Expected)</label>
                    <input class="form-control text-muted input-datepicker-month" value="{{ $edu->end_date ? $edu->end_date->format('m-Y') : '' }}" type="text" autocomplete="off" placeholder="MM-YYYY" maxlength="7" inputmode="numeric" name="edu[{{$eduIndex}}][end_date]" />
                    <label class="inline-flex items-center mt-1">
                        <input class="rounded border-[#f4ede7] text-[var(--accent-color)] focus:ring-[var(--accent-color)]" {{ $edu->end_date ? '' : 'checked' }} type="checkbox" name="edu[{{$eduIndex}}][is_current]" value="1"/>
                        <span class="ml-2 text-xs text-[#9c7349]">Currently working here</span>
                    </label>
                    <div class="invalid-note"></div>
                </div>
            </div>
            @php
            $eduIndex++;
            @endphp
            @endforeach
            @endif
        </div>
        <div class="mt-auto">
            <x-client.elements.button type="button" class="h-12 w-full flex justify-center items-center gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl" onclick="addElement('educations')">
                <i class="bi bi-plus-lg"></i><span>Add Education</span>
            </x-client.elements.button>
        </div>
    </div>
</section>