@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Pago')
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
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                        data-id="fb5deb5" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <!-- Detalles de pago -->
                                            <div class="elementor-widget-container mt-5" style="width: 80%">
                                                <h2 style="text-align:center; color:white; padding-bottom: 20px; margin-top: 40px;">Detalles de pago</h2>
                                                <div style="border: 1px solid white; padding: 15px;">
                                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color:white;">
                                                        <div>
                                                            <p>Concepto: Pago de factura nº32384798234</p>
                                                            <p>Cantidad: 20,45€</p>
                                                            <p>Estado: Pendiente</p>
                                                        </div>
                                                        <div>
                                                            <p>Número de factura: 12331123</p>
                                                            <p>Fecha de emisión: 12/12/2023</p>
                                                            <p>Fecha de finalización: 22/12/2023</p>
                                                        </div>
                                                    </div>
                                                    <p style="color:white;">Razón de finalización:</p>
                                                    <p style="color:white;">Esta en la razón de finalización</p>
                                                </div>
                                                <div style="text-align: center; padding-top: 20px;">
                                                    <button style="border: none; padding: 10px 20px; background-color: black; color: white; cursor: pointer;">Crear incidencia</button>
                                                </div>
                                            </div>
                                            <!-- Fin Detalles de pago -->
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
