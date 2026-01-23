<!-- CV PROMO SECTION -->
<section class="py-12 bg-background">
    <div class="container mx-auto px-4">
        <!-- <div class="bg-gradient-to-r from-emerald-50 to-green-100 rounded-3xl p-8 md:p-12 shadow-sm border border-green-100 flex flex-col md:flex-row items-center relative overflow-hidden"> -->
        <div class="bg-[#f0f0f0] p-8 md:p-12 shadow-sm border border-green-100 flex flex-col md:flex-row items-center relative overflow-hidden">

            <!-- Decorative Circle -->
            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/4 w-[500px] h-[500px] bg-white rounded-full opacity-40 blur-3xl pointer-events-none"></div>

            <div class="w-full md:w-1/2 z-10 mb-8 md:mb-0">
                <h2 class="text-2xl md:text-3xl font-bold text-red-500 mb-2 uppercase alumni-font">{{ __('default.txt_register_cv_title_1') }}</h2>
                <h3 class="text-xl md:text-3xl font-bold text-gray-800 mb-4 uppercase alumni-font">{{ __('default.txt_register_cv_title_2') }}</h3>
                <p class="text-gray-600 mb-8 max-w-lg leading-relaxed alumni-font">
                    {{ __('default.txt_register_cv_des') }}
                </p>
                <x-client.elements.button type="button" id="register_cv" class="font-bold py-3 px-8 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2 group alumni-font">
                    {{ __('default.txt_register_cv_btn') }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12h.5m3 0h1.5m3 0h6" /><path d="M15 16l4 -4" /><path d="M15 8l4 4" /></svg>
                </x-client.elements.button>
            </div>

            <div class="w-full md:w-1/2 flex justify-center z-10">
                <div class="relative w-full max-w-md">
                    <div class="bg-blue-200 rounded-2xl p-4 transform rotate-3 hover:rotate-0 transition-transform duration-500 shadow-xl">
                        <div class="bg-white rounded-xl overflow-hidden shadow-inner border border-gray-100 aspect-[4/3] flex items-center justify-center bg-[url('https://cdn.dribbble.com/users/129972/screenshots/3964640/attachments/906660/cv-cover.png')] bg-cover bg-center">
                            <img src="{{ asset('client/assets/img/logo-create-cv.png') }}" alt="CV Cover" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                        <span class="text-xl">🔔</span>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-[var(--accent-color)] rounded-lg flex items-center justify-center shadow-lg transform -rotate-12 p-2 border-2 border-white">
                        <span class="text-white text-2xl font-bold alumni-font">CV</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
    <x-client.create-cv />
    @endauth

<script>
    $(document).ready(function() {
        $('#register_cv').click(function() {
            if (!{{ auth()->check() ? 'true' : 'false' }}) {
                window.location.href = '/login';
                return;
            }
            $('#CreateCVModal').modal('show');
        });
    });
</script>
</section>