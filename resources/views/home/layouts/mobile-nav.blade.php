<div id="uicore-back-to-top" class="uicore-back-to-top uicore-i-arrow uicore_hide_mobile "></div>
<div class="uicore-navigation-wrapper uicore-navbar elementor-section elementor-section-boxed uicore-mobile-menu-wrapper
        ">
    <nav class="uicore elementor-container">
        <div class="uicore-branding uicore-mobile">
            <a href="index.html" rel="home">
                <h3>eBISU</h3>
            </a>
        </div>
        <div class="uicore-branding uicore-desktop">
        </div>
        <button type="button" class="uicore-toggle uicore-ham" aria-label="mobile-menu">
            <span class="bars">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </span>
        </button>
    </nav>
    <div class="uicore-navigation-content">
        @if(request()->is('/')) 
            <div class="uicore-menu-container uicore-nav">
                <ul class="uicore-menu">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8"><a
                            href="#Nosotros"><span class="ui-menu-item-wrapper">Nosotros</span></a></li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9"><a
                            href="#Servicios"><span class="ui-menu-item-wrapper">Servicios</span></a></li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10"><a
                            href="#Integraticiones"><span class="ui-menu-item-wrapper">Integraticiones</span></a></li>
                </ul>
            </div>
        @endif
        <x-session-role-buttons />
    </div>
</div>