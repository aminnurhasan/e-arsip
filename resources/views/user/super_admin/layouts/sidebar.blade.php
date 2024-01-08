<aside class="main-sidebar sidebar-light-secondary elevation-4" style="background-color: lightgray; position: fixed">
    <a href="{{route('dashboardSuperAdmin')}}" class="brand-link">
      <img src="{{asset('adminlte/dist/img/e.png')}}" alt="E Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">- Arsip Kab. Lamongan</span>
    </a>

    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          {{-- <div class="user-panel pb-2 mb-3 font-weight-light" style="text-align: center; font-size: 15px">
            {{Auth::user()->jabatan}}
          </div> --}}
          {{-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-gauge"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/superadmin/user')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-user"></i>
              <p>User</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/superadmin/agenda')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-calendar-days"></i>
              <p>Agenda</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>