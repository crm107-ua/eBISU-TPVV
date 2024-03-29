<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
      <ul class="navbar-nav w-100">
        <li class="nav-item w-100">
          <form class="nav-link">
            <input type="text" style="color:white;" class="form-control" id="searchInput" placeholder="Buscar">
            <div id="suggestions" style="black; display: none;">
                <!-- Las sugerencias aparecen aqui -->
            </div>
        </form>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
            <div class="navbar-profile">
              <img class="img-xs rounded-circle" src="/assets/images/faces/admin.png" alt="">
              <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
              <i class="mdi mdi-menu-down d-none d-sm-block"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
            <h6 class="p-3 mb-0">Perfil</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-account-key text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Role: {{Auth::user()->role}}</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-logout text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Cerrar sesión</p>
              </div>
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
    </div>
  </nav>

<!-- Formulario oculto para logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

<!-- Paso de rutas a js desde blade -->
<script type="text/javascript">
  var LaravelRoutes = {
      dashboard: "{{ route('admin.dashboard') }}",
      business: "{{ route('admin.business') }}",
      admins: "{{ route('admin.admins') }}",
      technicians: "{{ route('admin.technicians') }}",
      tickets: "{{ route('admin.tickets') }}",
      tokens: "{{ route('admin.tokens') }}",
      createAdmin: "{{ route('admin.admins.create.post') }}",
      createBusiness: "{{ route('admin.business.create.post') }}",
      createTechnician: "{{ route('admin.technicians.create.post') }}"
  };
</script>
