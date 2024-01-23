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