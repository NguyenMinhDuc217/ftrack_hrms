
<!-- STATS SECTION -->
<section class="bg-[#f0f0f0] py-10 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-white rounded-full mix-blend-overlay blur-3xl"></div>
        <div class="absolute bottom-10 right-20 w-60 h-60 bg-yellow-300 rounded-full mix-blend-overlay blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x-0 md:divide-x divide-green-400/30">
            <div class="flex flex-col items-center">
                <span class="text-4xl md:text-5xl font-bold  mb-2">12+</span>
                <span class="text-sm md:text-base font-medium">{{ __('default.txt_job') }}</span>
                <span class="text-xs mt-1">{{ __('default.txt_newest') }}</span>
            </div>
            <div class="flex flex-col items-center text-[var(--blue-color)]">
                <span class="text-4xl md:text-5xl font-bold  mb-2">30+</span>
                <span class="text-sm md:text-base font-medium">{{ __('default.txt_user') }}</span>
                <span class="text-xs mt-1">{{ __('default.txt_everyday') }}</span>
            </div>
            <div class="flex flex-col items-center text-[var(--accent-color)]">
                <span class="text-4xl md:text-5xl font-bold  mb-2">08+</span>
                <span class="text-sm md:text-base font-medium">{{ __('default.txt_partner') }}</span>
                <span class="text-xs mt-1">{{ __('default.txt_tepresentative') }}</span>
            </div>
            <div class="flex flex-col items-center text-[var(--red-color)]">
                <span class="text-4xl md:text-5xl font-bold  mb-2">10%</span>
                <span class="text-sm md:text-base font-medium">{{ __('default.txt_personnel_growth') }}</span>
                <span class="text-xs mt-1">{{ __('default.txt_fastest_adaptation') }}</span>
            </div>
        </div>
    </div>
</section>