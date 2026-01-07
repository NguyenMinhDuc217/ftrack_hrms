<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <img src="{{ asset('client/assets/img/cpm-logo.webp') }}" class="img-fluid logo-lg" style="width: 150px !important;" alt="logo">
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
                @can('admin.users')
                <li class="pc-item">
                    <a href="{{ route("admin.users") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Users</span>
                    </a>
                </li>
                @endcan
                @can('admin.role.index')
                 <li class="pc-item">
                    <a href="{{ route("admin.role.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Roles</span>
                    </a>
                </li>
                @endcan
                @can('admin.permission.index')
                <li class="pc-item">
                    <a href="{{ route("admin.permission.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-git-fork"></i></span>
                        <span class="pc-mtext">Permission</span>
                    </a>
                </li>
                @endcan
                @can('admin.jobs.index')
                 <li class="pc-item">
                    <a href="{{ route("admin.jobs.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-briefcase"></i></span>
                        <span class="pc-mtext">Jobs</span>
                    </a>
                </li>
                @endcan
                <!-- <li class="pc-item">
                    <a href="{{ route("admin.blogs.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-key"></i></span>
                        <span class="pc-mtext">Blogs</span>
                    </a>
                </li> -->
                @can('admin.orgs.index')
                <li class="pc-item">
                    <a href="{{ route("admin.orgs.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-affiliate"></i></span>
                        <span class="pc-mtext">Organizations</span>
                    </a>
                </li>
                @endcan
                @can('admin.applications.index')
                <li class="pc-item">
                    <a href="{{ route("admin.applications.index") }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                        <span class="pc-mtext">{{ __('default.txt_apply') }}</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
