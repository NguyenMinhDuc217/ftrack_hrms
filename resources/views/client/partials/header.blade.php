<header id="header" class="header d-flex align-items-center sticky-top py-2">
  <div class="container-fluid container-xl position-relative d-flex align-items-center container mx-auto px-4">

    <a href="{{ route('client.home') }}" class="logo d-flex align-items-center me-auto">
      <img src="{{ asset('client/assets/img/cpm-logo.webp') }}" alt="Logo">
    </a>

    <nav id="navmenu" class="navmenu">
      <ul class="max-h-max">
        <li><a href="{{ route('client.home') }}" class="{{ request()->routeIs('client.home') ? 'active' : '' }} alumni-font">{{ __('default.txt_home') }}</a></li>
        {{-- Other static links --}}

        @auth {{-- Checks if any user is authenticated --}}
          <!-- <li><a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">Dashboard</a></li> -->
          <li class="dropdown">
              <a href="#"><span class="alumni-font ">{{ __('default.txt_welcome') }}, {{ Auth::user()->full_name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                  <li><a href="{{ route('profile') }}" class="alumni-font ">{{ __('default.txt_profile') }}</a></li>
                  <li><a href="{{ route('cv.manage') }}" class="alumni-font ">{{ __('default.txt_cv') }}</a></li>
                  <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="alumni-font ">{{ __('default.txt_logout') }}</a>
                      </form>
                  </li>
              </ul>
          </li>
        @else {{-- User is a guest --}}
          <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }} alumni-font ">{{ __('default.txt_login') }}</a></li>
          <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }} alumni-font ">{{ __('default.txt_register') }}</a></li>
        @endauth

        @php
          $locale = app()->getLocale();
        @endphp
        <li class="align-items-center">
          @if (!empty($locale) && $locale == 'en')
          <a href="{{ route('language.switch',["locale"=>"vi"]) }}" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('default.vi')">
            <img src="{{ asset('files/flags/vi.svg') }}" alt="vi icon" style="width:20px;">
          </a>
          @elseif (!empty($locale) && $locale == 'vi')
          <a href="{{ route('language.switch',["locale"=>"en"]) }}" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="top" title ="@lang('default.en')">
            <img src="{{ asset('files/flags/en.svg') }}" alt="en icon" style="width:20px;">
          </a>
          @endif
        </li>

        @can('admin.dashboard')
        <li>
          <a class="p-2 px-4 rounded-0 bg-black text-white border-1 hover:!bg-white hover:!text-black hover:border-1 hover:border-black alumni-font " href="{{ route('admin.dashboard') }}">Admin</a>
        </li>
        @endcan

        <li>
          <div class="p-2 d-flex justify-content-center">
            <!-- <a class="p-2 px-4 rounded-circle alumni-font border-gradient-btn justify-content-center align-items-center" target="_blank" href="https://cpmvietnam.com/"> -->
            <a class="p-2 px-4 rounded-circle alumni-font justify-content-center align-items-center btn-link-cpm" target="_blank" title="CPM Vietnam" href="https://cpmvietnam.com/">
              <img src="{{asset('client/assets/img/icon-web-cpm-01.svg') }}" alt="CPM VIETNAM" class="h-9 w-auto" ></img>
            </a>
          </div>
          
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    

  </div>
</header>
<style>
  @property --angle {
    syntax: '<angle>';
    initial-value: 0deg;
    inherits: false;
  }

  .border-gradient-btn {
    width: 50px !important;
    height: 50px !important;
    position: relative;
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0;
    background: transparent;
    z-index: 1;
  }

  .border-gradient-btn::before {
    content: '';
    position: absolute;
    inset: 0px; /* Điều chỉnh để glow lệch ra ngoài - tăng số để glow xa hơn (offset) */
    border-radius: inherit;
    padding: 6px;
    background: conic-gradient(
      from var(--angle),
      var(--blue-color, #0000ff),
      var(--accent-color, #ff00ff),
      var(--red-color, #ff0000),
      #ff8000,
      #ffff00,
      #00ff00,
      #00ffff,
      #8000ff,
      var(--blue-color, #0000ff)
    );
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: exclude;
    -webkit-mask-composite: xor; /* Cho Safari */
    animation: rotate 2s linear infinite;
    filter: blur(8px); /* Tạo glow phát sáng - chỉnh số để mạnh/yếu hơn */
    opacity: 0.8; /* Độ trong suốt glow - chỉnh tùy thích */
    z-index: -1;
  }

  /* Optional: chạy nhanh hơn khi hover */
  .border-gradient-btn:hover, .btn-link-cpm:hover {
    animation-duration: 4s;
    animation-direction: reverse;
    transition: all 0.5s ease-in-out;
    animation: pulse 2s ease-in-out infinite;
  }

  @keyframes rotate {
    to {
      --angle: 360deg;
    }
  }
  @keyframes pulse {
    50% {
      transform: scale(1.25);
    }
  }
</style>