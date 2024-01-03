@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Generar token')
@section('content')
<div class="uicore-body-content">
    <div id="uicore-page">
        @include('home.layouts.nav')
        <div id="content" class="uicore-content">
            <script id="uicore-page-transition"></script>
            <div id="primary" class="content-area">
                <article id="post-13" class="post-13 page type-page status-publish hentry">
                    <main class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="13" class="elementor elementor-13">
                            <div class="elementor-section elementor-top-section elementor-element elementor-element-38fe679 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="38fe679" data-element_type="section" id="Nosotros"
                                data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                                <div class="elementor-container elementor-column-gap-no" style="margin-bottom: 20%;">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                        data-id="fb5deb5" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div style="background-color: #f2f2f2; width: 100%; padding: 20px; border-radius: 8px; margin-top: 50px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                <h3 style="margin-bottom: 20px; text-align: left;">Token de eBISU API</h3>
                                                <div style="background-color: white; padding: 20px; border-radius: 8px;">
                                                    <p><strong>Mi token:</strong></p>
                                                    <input type="text" value="a442fgewwqvx56GPDP345eerrgetgerwewnm_&1" readonly style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                                                    <p>Fecha de expiración: 12/12/2023</p>
                                                    <p>Nº de usos: 6573</p>
                                                    <p>Nº de usos totales: 16522</p>
                                                    <div style="text-align: right; padding-top: 20px;">
                                                        <button style="border: none; padding: 10px 20px; background-color: #333; color: white; border-radius: 4px; cursor: pointer;">Generar nuevo</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </article>
            </div>
        </div>
        @include('home.layouts.footer')
    </div>
    @include('home.layouts.mobile-nav')
</div>
@endsection
