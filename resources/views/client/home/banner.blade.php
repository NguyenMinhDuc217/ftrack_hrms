<style>
    .profession_selected {
        color: var(--blue-color) !important;
        text-decoration: underline;
    }
</style>
<div class="relative w-full bg-background">
    <!-- Blue Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-[40px] sm:h-[400px] relative overflow-hidden flex items-center justify-center">
        <img src="{{ asset('client/assets/img/banner.png') }}"
            alt="Professional Woman"
            class="h-[400px] object-cover object-center translate-y-4 md:translate-y-0" />
    </div>

    <!-- Search Box -->
    <div class="container mx-auto px-4 -mt-8 md:-mt-12 relative z-20">
        <div class="bg-white rounded-0 shadow-xl p-3 md:p-6  border border-gray-100">

            <div class="flex flex-col md:flex-row items-start gap-3">
                <div class="flex-1 w-full flex flex-col gap-2">
                    <div class="flex items-center relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="bi bi-search h-5 w-5"></i>
                        </div>
                        <input
                            type="text"
                            id="search"
                            class="block w-full h-[53.6px] pl-10 pr-3 py-3 border border-border-[--var(--accent-color)] rounded-0 bg-gray-50 text-text-light placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="{{__('default.txt_home_search_placeholder')}}" 
                            value="{{ $search ?? '' }}"
                            />
                    </div>
                </div>
    
                <div class="w-full md:w-1/4 relative group flex flex-col gap-2">
                    <div class="flex items-center relative group">
                        <select id="listProvince" class="select2-single form-control block w-full pl-3 pr-10 py-3 !border !border-gray-200 rounded-0 leading-5 bg-gray-50 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-sm appearance-none transition-colors text-gray-700"
                        >
                            <option value="">{{__('default.txt_location')}}</option>
                            @foreach($provinces  as $province)
                            <option value="{{ $province->code_name }}" {{ isset($province_code_name) && $province->code_name == $province_code_name ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </div>
                    </div>
                </div>
    
                <div class="w-full md:w-auto flex gap-3 h-[53.6px]">
                    <x-client.elements.button type="button" class="flex-1 px-12 py-auto text-sm font-medium  hover:shadow-xl transition-all duration-200" onclick="filterJobs()">
                        <i class="ti ti-search text-xl"></i>
                    </x-client.elements.button>
        
                    <a href="{{ route('client.home') }}" class="w-1/3 py-3 px-4 flex justify-center items-center border border-transparent text-sm font-medium rounded-0 bg-light hover:bg-gray-100  hover:text-primary hover:shadow-xl transition-all duration-200"><i class="ti ti-eraser text-xl"></i></a>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-3 mt-2">
                <div class="flex-1 flex flex-wrap gap-2 md:gap-4">
                    @foreach ($professions_tips as $profession_tip)
                        <a id="profession_slug_{{ $profession_tip->slug }}" 
                            onclick="setSearchAndFocus(event,'profession_slug', '{{ $profession_tip->slug }}')" 
                            class="text-sm underline {{!empty($profession_slug) && $profession_slug == $profession_tip->slug ? 'profession_selected' : 'text-gray-400'}} cursor-pointer hover:text-primary transition-colors">
                            {{ $profession_tip->localized_name }}
                        </a>
                    @endforeach
                    <input type="hidden" id="profession_slug" value="{{!empty($profession_slug) ? $profession_slug : ''}}">
                </div>

                <div class="w-full md:w-1/4">
                    <button onclick="getCurrentLocation()" class="text-sm underline text-gray-400 cursor-pointer hover:text-primary transition-colors flex items-center">
                        <i class="bi bi-geo-alt text-[var(--blue-color)] mr-1"></i>
                        {{ __('default.txt_get_current_location') }}
                    </button>
                </div>

                <div class="hidden md:block w-[200px]"></div> 
            </div>
        </div>
    </div>
</div>
<script>
    function setSearchAndFocus(event, id, value) {
        $('#'+id).val(value);
        $('#'+id).focus();
        $('.profession_selected').addClass('text-gray-400').removeClass('profession_selected')
        var a = $(event.currentTarget)
        a.addClass('profession_selected')
        filterJobs('profession_slug', value);
    }

    function getCurrentLocation() {
         const preloader = document.querySelector('#preloader');
        
        // 1. Hiển thị loading màn hình
        if (preloader) {
            preloader.style.display = 'block';
            preloader.style.opacity = '1';
        }
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                $.ajax({
                    url: '{{ route('client.current.location') }}',
                    type: 'GET',
                    data: {
                        latitude: latitude,
                        longitude: longitude
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            const code_name = response.code_name;
                            console.log(response)
                            $('#listProvince').find('option[value="' + code_name + '"]').prop('selected', true).trigger('change');
                            filterJobs();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    // complete: function() {
                    //     // 2. Ẩn loading màn hình
                    //     if (preloader) {
                    //         preloader.style.opacity = '0';
                    //         setTimeout(() => { preloader.style.display = 'none'; }, 600);
                    //     }
                    // }
                });
                
            });
        } else {
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => { preloader.style.display = 'none'; }, 600);
            }
            console.log("Geolocation is not supported by this browser.");
        }
    }
</script>