@if(Auth()->check())
    @if(Auth::user()->role == \App\Enums\UserRole::Business)
        <div class="uicore uicore-extra">
            <div class="uicore-cta-wrapper">
                <a href="{{route('business-home')}}" target="_self" class="uicore-btn uicore-inverted">
                    <span class="elementor-button-text">{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
        @elseif(Auth::user()->role == \App\Enums\UserRole::Technician)
        <div class="uicore uicore-extra">
            <div class="uicore-cta-wrapper">
                <a href="{{route('technical-home')}}" target="_self" class="uicore-btn uicore-inverted">
                    <span class="elementor-button-text">{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
        @elseif(Auth::user()->role == \App\Enums\UserRole::Admin)
        <div class="uicore uicore-extra">
            <div class="uicore-cta-wrapper">
                <a href="{{route('admin.dashboard')}}" target="_self" class="uicore-btn uicore-inverted">
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
            <a href="{{route('login')}}" target="_self" class="uicore-btn uicore-inverted">
                <span class="elementor-button-text">Iniciar sesión</span>
            </a>
        </div>
    </div>
@endif
