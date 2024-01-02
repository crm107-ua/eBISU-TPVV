<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="/dashboard" style="color:white; text-decoration: none;" >eBISU
        <span  href="index.html" style="color:rgb(102, 240, 157); text-decoration: none;" >.pay</span></a>
    </div>
    <ul class="nav">
      <li class="nav-item menu-items">
        <a class="nav-link" href="/dashboard">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('comercios') ? 'active' : '' }}">
        <a class="nav-link" href="/comercios">
          <span class="menu-icon">
            <i class="mdi mdi-store"></i>
          </span>
          <span class="menu-title">Comercios</span>
        </a>
      </li>
      <li class="nav-item menu-items {{ request()->is('comercios-form') ? 'active' : '' }}">
        <a class="nav-link" href="/comercios-form">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Añadir comercio</span>
        </a>
      </li>
    </ul>
  </nav>