document.getElementById("searchInput").addEventListener("input", function() {
    var input = this.value;
    var suggestionsContainer = document.getElementById("suggestions");

    var searchOptions = {
        "Dashboard": { url: LaravelRoutes.dashboard, icon: "<i class='mdi mdi-speedometer'></i>" },
        "Listado de comercios": { url: LaravelRoutes.business, icon: "<i class='mdi mdi-store'></i>" },
        "Listado de admins": { url: LaravelRoutes.admins, icon: "<i class='mdi mdi-view-list'></i>" },
        "Listado de técnicos": { url: LaravelRoutes.technicians, icon: "<i class='mdi mdi-apple-finder'></i>" },
        "Listado de incidencias": { url: LaravelRoutes.tickets, icon: "<i class='mdi mdi-alert-outline'></i>" },
        "API Tokens": { url: LaravelRoutes.tokens, icon: "<i class='mdi mdi-key-change'></i>" }
    };

    suggestionsContainer.innerHTML = '';

    if (input.length > 0) {
        Object.keys(searchOptions).forEach(function(option) {
            if(option.toLowerCase().includes(input.toLowerCase())) {
                var a = document.createElement("a");
                a.href = searchOptions[option].url;
                a.classList.add("suggestion-link");

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
