<footer class="bg-[#F0F0F0] pb-2 relative overflow-hidden">
  <style>
    .background-image {
      position: relative;
      z-index: 1;
      overflow: hidden;
      width: 100%;
    }
    .background-image::before {
      content: "";
      position: absolute;
      top: 50%;
      right: -30%;
      transform: translateY(-23%);
      width: 150%;
      height: 200%;
      background-image: url('{{ asset('client/assets/img/bg_cpmicon.png') }}') !important;
      background-position: center !important;
      background-repeat: no-repeat !important;
      background-size: contain !important;
      z-index: -1 !important;
      opacity: 0.05 !important;
      pointer-events: none !important;
    }
    .footer-content {
      position: relative;
      z-index: 10 !important;
    }
    .container {
      position: relative;
      z-index: 2 !important;
    }
    .font-footer {
      font-weight: 600 !important;
      font-size: 22px !important;
      line-height: 1rem !important;
    }
    .font-title-footer {
      font-weight: 600 !important;
      font-size: 32px !important;
      letter-spacing: -0.5px !important;
    }
  </style>
  <div class="background-image">
    <div class="container mx-auto px-0 footer-content">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12 pt-[6rem]">
        <!-- Column 1: Brand & Address -->
        <div class="lg:col-span-1">
          <div class="flex items-center justify-center mb-6">
            <img width="220" src="{{ asset('client/assets/img/cpm-logo.webp') }}" alt="Logo">
          </div>

          
        </div>

        <!-- Column 2: Company -->
        <div class="lg:col-span-1 px-4">
          <h3 class="text-[var(--accent-color)] text-lg mb-6  tracking-wider alumni-font font-title-footer">{{ __('default.txt_company') }}</h3>
          <ul class="space-y-3 text-sm">
            <li>
              <a href="https://cpmvietnam.com/about-us/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_about_us') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_service') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/case-studies/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_case_studies') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/contact/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_contact') }}</span>
              </a>
            </li>
          </ul>
        </div>

        <div class="lg:col-span-1 px-4">
          <h3 class="text-[var(--accent-color)] text-lg mb-6  tracking-wider alumni-font font-title-footer">{{ __('default.txt_services') }}</h3>
          <ul class="space-y-3 text-sm">
              <li>
              <a href="https://cpmvietnam.com/merchandising-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_merchandising') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/auditing-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_auditing') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/posm-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_posm_deloyment') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/store-activation-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_store_activation') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/mystery-shopping-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_mystery_shopping') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/kpi-tracking-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_kpi_tracking') }}</span>
              </a>
            </li>
            <li>
              <a href="https://cpmvietnam.com/sales-force-services/" class="hover:text-primary transition-colors alumni-font flex items-center gap-2">
                <img src="{{asset('client/assets/img/icon-web-cpm-red.svg') }}" alt="CPM VIETNAM" class="h-3 w-auto" ></img>  
                <span class="font-footer">{{ __('default.txt_sales_force') }}</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Column 3: Contact/Newsletter -->
        <div class="lg:col-span-1 px-4">
          <h3 class="text-[var(--accent-color)]  text-lg mb-6  tracking-wider alumni-font font-title-footer">{{ __('default.txt_get_in_touch') }}</h3>
          <ul class="space-y-4 text-sm">
            <li class="flex items-center gap-3">
              <span class="font-footer alumni-font">tuyendung@cpm-vietnam.com</span>
            </li>
            <li class="flex items-center gap-3">
              <span class="font-footer alumni-font ">+84 89 831 23 23</span>
            </li>
            <li class="flex items-center gap-3">
              <span class=" alumni-font font-footer !leading-6" style="line-height: 1.5rem !important;">
                {{ __('default.txt_company_address') }}
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-[#e2e2e2] py-[1rem] flex flex-col md:flex-row justify-between items-center text-xs">
        <div class="flex gap-2">
          <a href="https://www.facebook.com/vieclamCPM" class="w-7 h-7 border border-black flex items-center justify-center"><i class="text-lg bi bi-facebook"></i></a>
          <a href="https://vn.linkedin.com/company/cpm-vietnam" class="w-7 h-7 border border-black flex items-center justify-center"><i class="text-lg bi bi-linkedin"></i></a>
          <a href="https://www.youtube.com/@CPMVietnam" class="w-7 h-7 border border-black flex items-center justify-center"><i class="text-lg bi bi-youtube"></i></a>
          <a href="https://www.tiktok.com/@cpmvietnamagency?lang=en" class="w-7 h-7 border border-black flex items-center justify-center"><i class="text-lg bi bi-tiktok"></i></a>
        </div>
        <p class="text-sm text-black !font-normal !text-[14px] !leading-[1.4rem] !tracking-[-0.3px]">© CPM Vietnam {{ date('Y') }}</p>
      </div>
    </div>
  </div>
</footer>