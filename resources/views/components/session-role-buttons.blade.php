@if(auth()->check()) 
    @if(auth()->user()->role == 'business') 
        <div class="uicore uicore-extra">
            <div class="uicore-cta-wrapper">
                <a href="/business-home" target="_self" class="uicore-btn uicore-inverted">
                    <span class="elementor-button-text">{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
    @else
        <div class="uicore uicore-extra">
            <div class="uicore-cta-wrapper">
                <a href="/technical-home" target="_self" class="uicore-btn uicore-inverted">
                    <span class="elementor-button-text">{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
    @endif
    <div class="uicore uicore-extra">
        <div class="uicore-cta-wrapper">
            <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="uicore-btn uicore-inverted">
                <span class="elementor-button-text">Cerrar sesión</span>
            </a>
        </div>
    </div>
@else
    <div class="uicore uicore-extra">
        <div class="uicore-cta-wrapper">
            <a href="/login" target="_self" class="uicore-btn uicore-inverted">
                <span class="elementor-button-text">Iniciar sesión</span>
            </a>
        </div>
    </div>
@endif
