<div class="relative w-full">
    <!-- Blue Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-[270px] sm:h-[270px] relative overflow-hidden flex items-center justify-center">
        <img src="{{ asset('client/assets/img/banner.png') }}"
            alt="Professional Woman"
            class="h-[300px] md:h-[400px] object-contain object-center translate-y-4 md:translate-y-0" />
    </div>

    <!-- Search Box -->
    <div class="container mx-auto px-4 -mt-8 md:-mt-12 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl p-3 md:p-6 flex flex-col md:flex-row items-center gap-4 border border-gray-100">

            <div class="flex-1 w-full relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-search" class="h-5 w-5"></i>
                </div>
                <input
                    type="text"
                    class="block w-full pl-10 pr-3 py-3 border-none rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-sm transition-colors"
                    placeholder="{{__('default.txt_home_search_placeholder')}}" />
            </div>

            <div class="w-full md:w-1/4 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i data-lucide="map-pin" class="h-5 w-5"></i>
                </div>
                <select class="block w-full pl-3 pr-10 py-3 border border-gray-200 rounded-md leading-5 bg-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-sm appearance-none transition-colors text-gray-700">
                    <option value="">{{__('default.txt_location')}}</option>
                    <option value="HN">Hà Nội</option>
                    <option value="HCM">TP. Hồ Chí Minh</option>
                    <option value="DN">Đà Nẵng</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>

            <button class="w-full md:w-auto px-8 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-[var(--accent-color)] hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg hover:shadow-xl transition-all duration-200">
                {{ __('default.txt_search') }}
            </button>
        </div>
    </div>
</div>