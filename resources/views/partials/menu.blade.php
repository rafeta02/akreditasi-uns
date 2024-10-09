<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/mahasiswas*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }} {{ request()->is("admin/mahasiswas*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('mahasiswa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.mahasiswas.index") }}" class="nav-link {{ request()->is("admin/mahasiswas") || request()->is("admin/mahasiswas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-graduate">

                                        </i>
                                        <p>
                                            {{ trans('cruds.mahasiswa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('master_akreditasi_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faculties*") ? "menu-open" : "" }} {{ request()->is("admin/jenjangs*") ? "menu-open" : "" }} {{ request()->is("admin/prodis*") ? "menu-open" : "" }} {{ request()->is("admin/lembaga-akreditasis*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/faculties*") ? "active" : "" }} {{ request()->is("admin/jenjangs*") ? "active" : "" }} {{ request()->is("admin/prodis*") ? "active" : "" }} {{ request()->is("admin/lembaga-akreditasis*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fab fa-adn">

                            </i>
                            <p>
                                {{ trans('cruds.masterAkreditasi.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faculty_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faculties.index") }}" class="nav-link {{ request()->is("admin/faculties") || request()->is("admin/faculties/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bars">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faculty.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('jenjang_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.jenjangs.index") }}" class="nav-link {{ request()->is("admin/jenjangs") || request()->is("admin/jenjangs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-level-up-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jenjang.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('prodi_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prodis.index") }}" class="nav-link {{ request()->is("admin/prodis") || request()->is("admin/prodis/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tasks">

                                        </i>
                                        <p>
                                            {{ trans('cruds.prodi.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('lembaga_akreditasi_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lembaga-akreditasis.index") }}" class="nav-link {{ request()->is("admin/lembaga-akreditasis") || request()->is("admin/lembaga-akreditasis/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-location-arrow">

                                        </i>
                                        <p>
                                            {{ trans('cruds.lembagaAkreditasi.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('akreditasi_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.akreditasis.index") }}" class="nav-link {{ request()->is("admin/akreditasis") || request()->is("admin/akreditasis/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-certificate">

                            </i>
                            <p>
                                {{ trans('cruds.akreditasi.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('akreditasi_intenasional_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.akreditasi-intenasionals.index") }}" class="nav-link {{ request()->is("admin/akreditasi-intenasionals") || request()->is("admin/akreditasi-intenasionals/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-certificate">

                            </i>
                            <p>
                                {{ trans('cruds.akreditasiIntenasional.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('ajuan_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.ajuans.index") }}" class="nav-link {{ request()->is("admin/ajuans") || request()->is("admin/ajuans/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-certificate">

                            </i>
                            <p>
                                {{ trans('cruds.ajuan.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
