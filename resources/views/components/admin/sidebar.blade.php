<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('admin/assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                @foreach ($menus as $menu)
                    <li class="pc-item">
                        <a href="{{ route($menu->route_name) }}" class="pc-link">
                            <span class="pc-micon"><i class="{{ $menu->icon }}"></i></span>
                            <span class="pc-mtext">{{ $menu->label }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
