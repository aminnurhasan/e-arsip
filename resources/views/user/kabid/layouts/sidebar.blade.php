<aside class="main-sidebar sidebar-light-secondary elevation-4" style="background-color: lightgray; position: fixed">
    <a href="{{route('dashboardKabid')}}" class="brand-link">
      <img src="{{asset('image/SIKAP Hitam.png')}}" alt="E Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIKAP Kab. Lamongan</span>
    </a>

    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <div class="user-panel mt-1 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user.svg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block">{{ substr(Auth::user()->name, 0, 20) }}</span>
            </div>
          </div>

          <li class="nav-item">
            <a href="{{url('/kabid/dashboard')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-gauge"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-calendar-days"></i>
              <p>
                Agenda
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/kabid/agenda')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agenda Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/kabid/agenda/saya')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agenda Saya</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{url('/kabid/disposisi')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-file-pen"></i>
              <p>Disposisi</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/kabid/arsip')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-box-archive"></i>
              <p>Arsip</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/kabid/dokumentasi')}}" class="nav-link d-block">
              <i class="nav-icon fa-solid fa-image"></i>
              <p>Dokumentasi</p>
            </a>
          </li>

          <div class="user-panel mt-1 pb-2 mb-3 d-flex"></div>

          <li class="nav-item">
            <a href="{{url('/kabid/gantipassword')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-key"></i>
              <p>Ganti Password</p>
            </a>
          </li>

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
      <!-- /.sidebar-menu -->
    </div>
    <div class="flex-grow-1"></div>
    <!-- /.sidebar -->
</aside>