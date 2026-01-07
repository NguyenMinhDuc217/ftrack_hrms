<footer class="bg-[#F0F0F0] pt-10 pb-2">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-12 mb-12">
      <!-- Column 1: Brand & Address -->
      <div class="lg:col-span-2">
        <div class="flex items-center justify-center mb-6">
          <img width="250" src="{{ asset('client/assets/img/cpm-logo.webp') }}" alt="Logo">
        </div>

       
      </div>

      <!-- Column 2: Company -->
      <div class="lg:col-span-1">
        <h3 class="text-[var(--accent-color)] font-bold text-lg mb-6 uppercase tracking-wider alumni-font ">{{ __('default.txt_company') }}</h3>
        <ul class="space-y-3 text-sm">
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_about_us') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_service') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_tutorial') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_news_blog') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_recruitment') }}</span></a></li>
        </ul>
      </div>

      <div class="lg:col-span-1">
        <h3 class="text-[var(--accent-color)] font-bold text-lg mb-6 uppercase tracking-wider alumni-font ">{{ __('default.txt_resources') }}</h3>
        <ul class="space-y-3 text-sm">
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_brand_identity') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_web_design') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_content_creation') }}</span></a></li>
          <li><a href="#" class="hover:text-primary transition-colors alumni-font "><i class="bi bi-asterisk text-[var(--red-color)] mr-2"></i> <span class="font-bold">{{ __('default.txt_video_marketing') }}</span></a></li>
        </ul>
      </div>

      <!-- Column 3: Contact/Newsletter -->
      <div class="lg:col-span-2">
        <h3 class="text-[var(--accent-color)] font-bold text-lg mb-6 uppercase tracking-wider alumni-font">{{ __('default.txt_contact') }}</h3>
        <ul class="space-y-4 text-sm">
          <li class="flex items-center gap-3">
            <span class="font-bold alumni-font">info@ftrack.vn</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="font-bold alumni-font ">+84 909 876 543</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="font-bold alumni-font">
              {{ __('default.txt_company_address') }}
            </span>
          </li>
        </ul>
      </div>
    </div>

    <div class="border-t border-[#e2e2e2] pt-2 flex flex-col md:flex-row justify-between items-center text-xs">
      <div class="flex gap-3">
        <a href="#" class="w-7 h-7 border border-black flex items-center justify-center"><i class="text-lg bi bi-facebook"></i></a>
        <a href="#" class="w-7 h-7 border border-black flex items-center justify-center"><i class="text-lg bi bi-youtube"></i></a>
      </div>
      <p class="font-bold text-sm alumni-font">© CPM Vietnam {{ date('Y') }}</p>
    </div>
  </div>
</footer>