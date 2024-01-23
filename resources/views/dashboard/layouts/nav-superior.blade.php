<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
      <ul class="navbar-nav w-100">
        <li class="nav-item w-100">
          <form class="nav-link">
            <input type="text" style="color:white;" class="form-control" id="searchInput" placeholder="Buscar">
            <div id="suggestions" style="black; display: none;">
                <!-- Las sugerencias aparecerán aquí -->
            </div>
        </form>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
            <div class="navbar-profile">
              <img class="img-xs rounded-circle" src="/assets/images/faces/face15.jpg" alt="">
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
                  <i class="mdi mdi-settings text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Ajustes</p>
              </div>
            </a>
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

<style>
#suggestions {
    position: absolute;
    width: 80%;
    box-sizing: border-box;
    z-index: 99;
}

#suggestions a {
    padding: 25px;
    border: 1px solid black;
    background-color: #38425e;
    margin-top: 5px;
    margin-bottom: 5px;
    cursor: pointer;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    display: block; 
}

.suggestion-link {
    display: block;
    padding: 25px; 
    border: 1px solid black;
    background-color: #38425e;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 5px;
}

.suggestion-link:hover {
    background-color: #f0f0f0; 
    color: black;
}

.icon-container {
    display: inline-block;
    vertical-align: middle;
}

.text-container {
    display: inline-block; 
    vertical-align: middle; 
    margin-left: 10px;
}


</style>

<script>
document.getElementById("searchInput").addEventListener("input", function() {
    var input = this.value;
    var suggestionsContainer = document.getElementById("suggestions");
    // Opciones de búsqueda actualizadas con íconos
    var searchOptions = {
        "Dashboard": { url: "/dashboard", icon: "<i class='mdi mdi-speedometer'></i>" },
        "Añadir comercio": { url: "/comercios-form", icon: "<i class='mdi mdi-basket'></i>" },
        "Añadir administrador": { url: "/admin-form", icon: "<i class='mdi mdi-account-plus'></i>" },
        "Añadir técnico": { url: "/tecnico-form", icon: "<i class='mdi mdi-account-plus'></i>" },
        "Listado de comercios": { url: "/listado-comercios", icon: "<i class='mdi mdi-store'></i>" },
        "Listado de administradores": { url: "/listado-admins", icon: "<i class='mdi mdi-view-list'></i>" },
        "Listado de técnicos": { url: "/listado-tecnicos", icon: "<i class='mdi mdi-apple-finder'></i>" },
        "Listado de incidencias": { url: "/listado-incidencias", icon: "<i class='mdi mdi-alert-outline'></i>" },
        "Detalles de incidencia": { url: "/detalles-incidencia", icon: "<i class='mdi mdi-account-card-details'></i>" },
        "API Tokens": { url: "/tokens-admin", icon: "<i class='mdi mdi-key-change'></i>" }
    };

    suggestionsContainer.innerHTML = '';

    if (input.length > 0) {
        Object.keys(searchOptions).forEach(function(option) {
            if(option.toLowerCase().includes(input.toLowerCase())) {
                var a = document.createElement("a");
                a.href = searchOptions[option].url;
                a.classList.add("suggestion-link");

                // Crear un contenedor para el ícono y el texto
                var iconSpan = document.createElement("span");
                iconSpan.innerHTML = searchOptions[option].icon;
                iconSpan.classList.add("icon-container");

                var textSpan = document.createElement("span");
                textSpan.textContent = option;
                textSpan.classList.add("text-container");

                a.appendChild(iconSpan);
                a.appendChild(textSpan);

                suggestionsContainer.appendChild(a);
            }
        });
    }

    suggestionsContainer.style.display = Object.keys(searchOptions).length > 0 ? "block" : "none";
});

</script>