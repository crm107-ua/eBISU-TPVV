@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Valoraciones')
@section('content')
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
                                        <p style="color:white;">Trabajando en eBISU desde: 2012 - Valoración media: ★★★★☆</p>
{{--                                        <div class="mt-5 reviews-container">--}}
{{--                                            <div class="review-item">--}}
{{--                                                <h3 style="color:white;">Sofía - Tienda de Ropa</h3>--}}
{{--                                                <div class="review-rating">★★★★☆</div>--}}
{{--                                                <p>El técnico asignado, Jose Luis, proporcionó un servicio excepcional durante todo el proceso. Se mostró receptivo desde el principio, haciendo preguntas clave para comprender la naturaleza del problema. La comunicación fue clara y precisa, lo que ayudó a establecer una base sólida para la resolución del problema.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        @foreach($valorations as $valoration)
                                            <h1 style="color:#FFFFFF;">{{$valoration->valoration_valoration}}</h1>
                                        @endforeach
                                        {!! $valorations->links() !!}
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </article>
    </div>
</div>
@endsection
