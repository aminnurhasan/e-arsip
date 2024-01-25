<aside class="main-sidebar sidebar-light-secondary elevation-4" style="background-color: lightgray; position: fixed">
    <a href="{{route('dashboardSuperAdmin')}}" class="brand-link">
      <img src="{{asset('adminlte/dist/img/e.png')}}" alt="E Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">- Arsip Kab. Lamongan</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <div class="user-panel mt-1 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user.svg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block">{{ Auth::user()->name }}</span>
            </div>
          </div>

          <li class="nav-item">
            <a href="{{url('/superadmin/dashboard')}}" class="nav-link">
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

          <li class="nav-item">
            <a href="{{url('/superadmin/arsip')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-box-archive"></i>
              <p>Arsip</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/superadmin/dokumentasi')}}" class="nav-link d-block">
              <i class="nav-icon fa-solid fa-image"></i>
              <p>Dokumentasi</p>
            </a>
          </li>

          <div class="user-panel mt-1 pb-2 mb-3 d-flex"></div>

          <li class="nav-item">
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <a href="{{route("logout")}}" class="nav-link d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="flex-grow-1"></div>
</aside>