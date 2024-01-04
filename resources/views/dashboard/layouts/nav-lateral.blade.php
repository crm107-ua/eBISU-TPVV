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
      <li class="nav-item menu-items {{ request()->is('comercios-form') ? 'active' : '' }}">
        <a class="nav-link" href="/comercios-form">
          <span class="menu-icon">
            <i class="mdi mdi-basket"></i>
          </span>
          <span class="menu-title">Añadir comercio</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('admin-form') ? 'active' : '' }}">
        <a class="nav-link" href="/admin-form">
          <span class="menu-icon">
            <i class="mdi mdi-account-plus"></i>
          </span>
          <span class="menu-title">Añadir administrador</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('tecnico-form') ? 'active' : '' }}">
        <a class="nav-link" href="/tecnico-form">
          <span class="menu-icon">
            <i class="mdi mdi-account-plus"></i>
          </span>
          <span class="menu-title">Añadir técnico</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('listado-comercios') ? 'active' : '' }}">
        <a class="nav-link" href="/listado-comercios">
          <span class="menu-icon">
            <i class="mdi mdi-store"></i>
          </span>
          <span class="menu-title">Listado de comercios</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('listado-admins') ? 'active' : '' }}">
        <a class="nav-link" href="/listado-admins">
          <span class="menu-icon">
            <i class="mdi mdi-view-list"></i>
          </span>
          <span class="menu-title">Listado de admins</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('listado-tecnicos') ? 'active' : '' }}">
        <a class="nav-link" href="/listado-tecnicos">
          <span class="menu-icon">
            <i class="mdi mdi-apple-finder"></i>
          </span>
          <span class="menu-title">Listado de tecnicos</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('listado-incidencias') ? 'active' : '' }}">
        <a class="nav-link" href="/listado-incidencias">
          <span class="menu-icon">
            <i class="mdi mdi-alert-outline"></i>
          </span>
          <span class="menu-title">Listado de incidencias</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('detalles-incidencia') ? 'active' : '' }}">
        <a class="nav-link" href="/detalles-incidencia">
          <span class="menu-icon">
            <i class="mdi mdi-account-card-details"></i>
          </span>
          <span class="menu-title">Detalles de incidencia</span>
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
