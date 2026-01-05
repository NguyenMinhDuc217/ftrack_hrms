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
                <!-- <li class="pc-item">
                    <a href="{{ route("admin.dashboard") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li> -->
                <li class="pc-item">
                    <a href="{{ route("admin.users") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Users</span>
                    </a>
                </li>
                 <li class="pc-item">
                    <a href="{{ route("admin.role.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Roles</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route("admin.permission.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Permission</span>
                    </a>
                </li>
                 <li class="pc-item">
                    <a href="{{ route("admin.jobs.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Jobs</span>
                    </a>
                </li>
                <!-- <li class="pc-item">
                    <a href="{{ route("admin.blogs.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Blogs</span>
                    </a>
                </li> -->
                <li class="pc-item">
                    <a href="{{ route("admin.orgs.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Organizations</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
