@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Técnico')
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
                                            <!-- Aquí comienza la tabla de historial de incidencias -->
                                            <div class="elementor-element elementor-element-70b0e81 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor"
                                                data-id="70b0e81" data-element_type="widget"
                                                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
                                                data-widget_type="text-editor.default">
                                                <div class="elementor-widget-container mt-5">
                                                    <h2 style="text-align:center; color:white;" class="mb-4">Incidencias activas</h2>
                                                    <table style="width:100%; margin-top:20px; text-align:center; border-collapse: collapse;">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-bottom: 2px solid #000; padding: 10px 0; color:white;">Título</th>
                                                                <th style="border-bottom: 2px solid #000; padding: 10px 0; color:white;">Estado</th>
                                                                <th style="border-bottom: 2px solid #000; padding: 10px 0; color:white;">Valoración</th>
                                                                <th style="border-bottom: 2px solid #000; padding: 10px 0; color:white;">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding: 10px 0; color:white;">Problema con la Transacción de Pago 0</td>
                                                                <td style="padding: 10px 0; color:white;">PENDIENTE</td>
                                                                <td style="padding: 10px 0; color:white;">★★★★☆</td>
                                                                <td style="padding: 10px 0; color:white;"><a href="#" style="all: unset">Resolver</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 10px 0; color:white;">Problema con la Transacción de Pago 1</td>
                                                                <td style="padding: 10px 0; color:white;">PENDIENTE</td>
                                                                <td style="padding: 10px 0; color:white;">★★★★☆</td>
                                                                <td style="padding: 10px 0; color:white;"><a href="#" style="all: unset">Resolver</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 10px 0; color:white;">Problema con la Transacción de Pago 2</td>
                                                                <td style="padding: 10px 0; color:white;">PENDIENTE</td>
                                                                <td style="padding: 10px 0; color:white;">★★★★☆</td>
                                                                <td style="padding: 10px 0; color:white;"><a href="#" style="all: unset">Resolver</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 10px 0; color:white;">Problema con la Transacción de Pago 3</td>
                                                                <td style="padding: 10px 0; color:white;">PENDIENTE</td>
                                                                <td style="padding: 10px 0; color:white;">★★★★☆</td>
                                                                <td style="padding: 10px 0; color:white;"><a href="#" style="all: unset">Resolver</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 10px 0; color:white;">Problema con la Transacción de Pago 4</td>
                                                                <td style="padding: 10px 0; color:white;">PENDIENTE</td>
                                                                <td style="padding: 10px 0; color:white;">★★★★☆</td>
                                                                <td style="padding: 10px 0; color:white;"><a href="#" style="all: unset">Resolver</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 10px 0; color:white;">Problema con la Transacción de Pago 5</td>
                                                                <td style="padding: 10px 0; color:white;">PENDIENTE</td>
                                                                <td style="padding: 10px 0; color:white;">★★★★☆</td>
                                                                <td style="padding: 10px 0; color:white;"><a href="#" style="all: unset">Resolver</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <nav class="mt-5 reviews-pagination d-flex justify-content-center">
                                                        <ul class="pagination">
                                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">«</a></li>
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                                                        </ul>
                                                    </nav>                                                    
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
