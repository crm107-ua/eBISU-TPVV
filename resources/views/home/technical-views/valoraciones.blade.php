@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU')
@section('content')
    <div class="uicore-body-content">
        <div id="uicore-page">
            @include('home.layouts.nav')
            <div id="content" class="uicore-content">
                <script id="uicore-page-transition"> </script>
                <div id="primary" class="content-area">
                    <article id="post-13" class="post-13 page type-page status-publish hentry">
                        <main class="entry-content">
                            <div data-elementor-type="wp-page" data-elementor-id="13" class="elementor elementor-13">
                                <div class="elementor-section elementor-top-section elementor-element elementor-element-38fe679 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                    data-id="38fe679" data-element_type="section" id="Nosotros"
                                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                                    <div class="elementor-container elementor-column-gap-no" style="color:white;">
                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                            data-id="fb5deb5" data-element_type="column">
                                            <div class="mt-5 elementor-widget-wrap elementor-element-populated">
                                                <section class="reviews-section">
                                                    <h1 style="color:white;">Valoraciones sobre {{ Auth::user()->name }}</h1>
                                                    <p style="color:white;">Trabajando en eBISU desde: 2012</p>
                                                    <div class="mt-5 reviews-container">
                                                        <div class="review-item">
                                                            <h3 style="color:white;">Sofía - Tienda de Ropa</h3>
                                                            <div class="review-rating">★★★★☆</div>
                                                            <p>El técnico asignado, Jose Luis, proporcionó un servicio excepcional durante todo el proceso. Se mostró receptivo desde el principio, haciendo preguntas clave para comprender la naturaleza del problema. La comunicación fue clara y precisa, lo que ayudó a establecer una base sólida para la resolución del problema.</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5 reviews-container">
                                                        <div class="review-item">
                                                            <h3 style="color:white;">Carlos - Peluquería</h3>
                                                            <div class="review-rating">★★★☆☆</div>
                                                            <p>El técnico asignado, Jose Luis, proporcionó un servicio excepcional durante todo el proceso. Se mostró receptivo desde el principio, haciendo preguntas clave para comprender la naturaleza del problema. La comunicación fue clara y precisa, lo que ayudó a establecer una base sólida para la resolución del problema.</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5 reviews-container">
                                                        <div class="review-item">
                                                            <h3 style="color:white;">Luís - Tienda de pelotas</h3>
                                                            <div class="review-rating">★★★★★</div>
                                                            <p>El técnico asignado, Jose Luis, proporcionó un servicio excepcional durante todo el proceso. Se mostró receptivo desde el principio, haciendo preguntas clave para comprender la naturaleza del problema. La comunicación fue clara y precisa, lo que ayudó a establecer una base sólida para la resolución del problema.</p>
                                                        </div>
                                                    </div>
                                                </section>
                                                <nav class="mt-5 reviews-pagination">
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
                        </main>
                    </article>
                </div>
            </div>
            @include('home.layouts.footer')
        </div>  
        @include('home.layouts.mobile-nav')
    </div>
@endsection