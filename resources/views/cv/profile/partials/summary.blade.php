<section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden" id="personal">
    <style>
        .select2-selection {
            height: 37.6px !important;
        }
    </style>
    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class=" text-xl font-bold">Personal Information</h2>
        <i class="bi bi-person-fill text-xl"></i>
    </div>
    <div class="p-4 space-y-8">
        <!-- Photo Upload -->
        <div class="grid md:grid-cols-5 gap-2">
            <div class="col-span-1 flex flex-col items-start gap-2">
                <p class=" font-bold text-sm">PROFILE PHOTO</p>
                <div class="relative group">
                    <div class="size-24 rounded-lg bg-gray-100 border-2 border-[var(--accent-color)] flex items-center justify-center overflow-hidden">
                        <div class="absolute rounded-full size-7 bg-gray-200 flex justify-center items-center">
                            <i class="bi bi-camera text-xl text-[var(--accent-color)]"></i>
                        </div>
                        <img id="avatar-preview" class="size-24 rounded-lg object-cover" src="{{ $profile->avatar ? $profile->avatar->url : asset('images/profile/blank-profile.svg') }}" alt="Avatar">
                    </div>
                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer " name="info[avatar]" id="avatar-input" accept="image/*" onchange="previewAvatar(this)" />
                    <!-- <input type="hidden" name="info[avatar]" id="avatar-hidden" value="{{ $profile->avatar ? $profile->avatar->url : '' }}"> -->
                </div>
            </div>
            <div class="col-span-4 grid md:grid-cols-2 gap-4">
                <div class="col-span-1 flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ Str::upper(__('cv.full_name')) }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-muted" name="info[full_name]" value="{{ $profile->full_name ?? '' }}" required>
                    <div class="invalid-note"></div>
                </div>
                <div class="col-span-1 flex flex-col gap-2">
                    <label class="text-sm font-bold">{{ Str::upper(__('cv.professional_title')) }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-muted" name="info[title]" value="{{ $profile->title ?? '' }}" required placeholder="{{ __('cv.placeholder_title') }}">
                    <div class="invalid-note"></div>
                </div>
            </div>
        </div>
        <!-- Input Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold">{{ Str::upper(__('cv.gender')) }} <span class="text-danger">*</span></label>
                <select class="form-select text-muted" name="info[gender]" required>
                    <option value="">{{ __('cv.select') }}</option>
                    @foreach ($genders as $gender)
                    <option value="{{ $gender->value }}" {{ !empty($profile->gender) && $profile->gender->value == $gender->value ? 'selected' : '' }}>{{ $gender->getLabel()['lang'] }}</option>
                    @endforeach
                </select>
                <div class="invalid-note"></div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold">{{ Str::upper(__('cv.date_of_birth')) }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-datepicker text-muted" name="info[date_of_birth]" value="{{ !empty($user->date_of_birth) ? date('Y-m-d', strtotime($user->date_of_birth)) : '' }}">
                <div class="invalid-note"></div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold">{{ Str::upper(__('cv.phone_number')) }} <span class="text-danger">*</span></label>
                <input type="tel" class="form-control text-muted" name="info[phone_number]" value="{{ $profile->phone_number ?? '' }}" placeholder="{{ __('cv.placeholder_phone_number') }}">
                <div class="invalid-note"></div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold">{{ Str::upper(__('cv.province')) }} <span class="text-danger">*</span></label>
                <select class="select2-single form-select text-muted" name="info[province_code]" required>
                    <option value="">{{ __('cv.select_province') }}</option>
                    @foreach($provinces as $prov)
                    <option value="{{ $prov->code }}" {{ !empty($profile->province_code) && $profile->province_code == $prov->code ? 'selected' : '' }}>{{ $prov->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-note"></div>
            </div>
            <div class="md:col-span-2 flex flex-col gap-2">
                <label class="text-sm font-bold">{{ Str::upper(__('cv.address')) }}</label>
                <input type="text" class="form-control text-muted" name="info[address]" value="{{ $profile->address ?? '' }}" placeholder="{{ __('cv.placeholder_address') }}">
                <div class="invalid-note"></div>
            </div>
            <div class="md:col-span-2 flex flex-col">
                <label class="form-label text-sm font-bold">{{ Str::upper(__('cv.professional_summary')) }}</label>
                 <div id="info-editor" class="quill-editor bg-white" data-placeholder="{{ __('cv.placeholder_summary') }}">
                    {!! $profile->summary ?? '' !!}
                </div>
                <input type="hidden" name="info[summary]" id="info-input" value="{{ $profile->summary ?? '' }}">
                <div class="invalid-note"></div>
            </div>
        </div>
    </div>
    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                console.log(reader)
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</section>