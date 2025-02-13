<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{ route('dashboard') }}" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="{{ asset('/backend/assets/img/AdminLTELogo.png') }}"
          alt="Dashboard"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Dashboard</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(Route::is( 'dashboard')) active @endif">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>Dashboard</p>
            </a>
        </li>
        @can(['vehicles.index'])
        <li class="nav-item">
            <a href="{{route('vehicles.index')}}" class="nav-link @if(Route::is('vehicles.*')) active @endif">
              <i class="nav-icon bi bi-person"></i>
              <p>
                Vehicles
              </p>
            </a>
        </li>
        @endcan
        @can(['drivers.index'])
        <li class="nav-item">
            <a href="{{route('drivers.index')}}" class="nav-link @if(Route::is('drivers.*')) active @endif">
              <i class="nav-icon bi bi-person"></i>
              <p>
                Drivers
              </p>
            </a>
        </li>
        @endcan
        @can(['users.index', 'roles.index', 'permissions.index'])
        <li class="nav-item @if(Route::is('users.*') || Route::is('roles.*') || Route::is('permissions.*')) menu-open @endif">
            <a href="#" class="nav-link @if(Route::is('users.*') || Route::is('roles.*') || Route::is('permissions.*')) active @endif">
              <i class="nav-icon bi bi-person"></i>
              <p>
                Users Management
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link @if(Route::is('users.*')) active @endif">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>User List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link @if(Route::is('roles.*')) active @endif">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Role List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('permissions.index') }}" class="nav-link @if(Route::is('permissions.*')) active @endif">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Permission List</p>
                </a>
              </li>
            </ul>
          </li>
            @endcan
          @can('profile')
            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link @if(Route::is('profile')) active @endif">
                <i class="nav-icon bi bi-person"></i>
                <p>Profile</p>
                </a>
            </li>
            @endcan
        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
