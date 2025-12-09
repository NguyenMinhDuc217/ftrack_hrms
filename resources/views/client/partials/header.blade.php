<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="{{ route('client.home') }}" class="logo d-flex align-items-center me-auto">
      <!-- <h1 class="sitename">eNno</h1> -->
      <img src="{{ asset('client/assets/img/logo.png') }}" alt="Logo">
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('client.home') }}" class="{{ request()->routeIs('client.home') ? 'active' : '' }}">Home</a></li>
        {{-- Other static links --}}
        <li><a href="{{ route('client.home') }}#about">About</a></li>
        <li><a href="{{ route('client.home') }}#services">Services</a></li>
        <li><a href="{{ route('client.home') }}#portfolio">Portfolio</a></li>
        <li><a href="{{ route('client.home') }}#team">Team</a></li>
        <li><a href="{{ route('client.home') }}#contact">Contact</a></li>

        @auth {{-- Checks if any user is authenticated --}}
          <li><a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">Dashboard</a></li>
          <li class="dropdown">
              <a href="#"><span>Welcome, {{ Auth::user()->full_name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                  <li><a href="{{ route('client.profile') }}">Profile</a></li>
                  <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                      </form>
                  </li>
              </ul>
          </li>
        @else {{-- User is a guest --}}
          <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
          <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a></li>
        @endauth
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @guest
      <a class="btn-getstarted" href="{{ route('login') }}">Get Started (Login)</a>
    @endguest
    @can('admin.dashboard')
      <a class="btn-getstarted" href="{{ route('admin.dashboard') }}">Admin</a>
    @endcan

    <div class="text-left ps-3">
      @if (!empty($locale) && $locale == 'en')
      <a href="{{ route('language.switch',["locale"=>"vi"]) }}" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('default.vi')">
        <img src="{{ asset('files/flags/vi.svg') }}" alt="vi icon" style="width:20px;">
      </a>
      @elseif (!empty($locale) && $locale == 'vi')
      <a href="{{ route('language.switch',["locale"=>"en"]) }}" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="top" title ="@lang('default.en')">
        <img src="{{ asset('files/flags/en.svg') }}" alt="en icon" style="width:20px;">
      </a>
      @endif
    </div>
  </div>
</header>