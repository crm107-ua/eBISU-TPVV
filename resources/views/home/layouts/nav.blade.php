<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite"
    class="uicore uicore-navbar elementor-section uicore-h-classic uicore-sticky ui-smart-sticky uicore-transparent ">
    <div class="uicore-header-wrapper">
        <nav class="uicore elementor-container">
            <div class="uicore-branding">
                <a href="/" rel="home" style="all: unset">
                    <h3 style="margin:3%; color:white;">eBISU</h3>
                </a>
            </div>
            <div class="uicore-nav-menu">
                @if(request()->is('/')) 
                    <div class="uicore-menu-container uicore-nav">
                        <ul class="uicore-menu">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8"><a
                                    href="#Nosotros"><span class="ui-menu-item-wrapper">Nosotros</span></a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9"><a
                                    href="#Servicios"><span class="ui-menu-item-wrapper">Servicios</span></a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10"><a
                                    href="#Integraticiones"><span
                                        class="ui-menu-item-wrapper">Integraticiones</span></a></li>
                        </ul>
                    </div>
                @endif
                <x-session-role-buttons />
            </div>
            <button type="button" class="uicore-toggle uicore-ham" aria-label="mobile-menu">
                <span class="bars">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </span>
            </button>
        </nav>
    </div>
</div>

<!-- Formulario oculto para logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>