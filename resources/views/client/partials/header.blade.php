<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="{{ route('client.home') }}" class="logo d-flex align-items-center me-auto">
      <!-- <h1 class="sitename">eNno</h1> -->
      <!-- <img src="{{ asset('client/assets/img/logo.png') }}" alt="Logo"> -->
      <img src="{{ asset('client/assets/img/cpm-logo.webp') }}" alt="Logo">
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('client.home') }}" class="{{ request()->routeIs('client.home') ? 'active' : '' }} alumni-font">Home</a></li>
        {{-- Other static links --}}

        @auth {{-- Checks if any user is authenticated --}}
          <!-- <li><a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">Dashboard</a></li> -->
          <li class="dropdown">
              <a href="#"><span class="alumni-font ">Welcome, {{ Auth::user()->full_name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                  <li><a href="{{ route('profile') }}" class="alumni-font ">User Profile</a></li>
                  <li><a href="{{ route('cv.manage') }}" class="alumni-font ">CV</a></li>
                  <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="alumni-font ">Logout</a>
                      </form>
                  </li>
              </ul>
          </li>
        @else {{-- User is a guest --}}
          <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }} alumni-font ">Login</a></li>
          <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }} alumni-font ">Register</a></li>
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
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    

  </div>
</header>