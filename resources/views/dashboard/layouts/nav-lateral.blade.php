<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard')}}" style="color:white; text-decoration: none;" >
          eBISU
          <span href="index.html" style="color:rgb(102, 240, 157); text-decoration: none;" >.pay</span>
      </a>
    </div>
    <ul class="nav">
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.dashboard')}}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('admin/business') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.business')}}">
          <span class="menu-icon">
            <i class="mdi mdi-store"></i>
          </span>
          <span class="menu-title">Listado de comercios</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('admin/admins') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.admins')}}">
          <span class="menu-icon">
            <i class="mdi mdi-view-list"></i>
          </span>
          <span class="menu-title">Listado de admins</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('admin/technicians') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.technicians')}}">
          <span class="menu-icon">
            <i class="mdi mdi-apple-finder"></i>
          </span>
          <span class="menu-title">Listado de tecnicos</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('admin/tickets') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.tickets')}}">
          <span class="menu-icon">
            <i class="mdi mdi-alert-outline"></i>
          </span>
          <span class="menu-title">Listado de incidencias</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('tokens-admin') ? 'active' : '' }}">
        <a class="nav-link" href="/tokens-admin">
          <span class="menu-icon">
            <i class="mdi mdi-key-change"></i>
          </span>
          <span class="menu-title">API Tokens</span>
        </a>
      </li>
    </ul>
  </nav>
