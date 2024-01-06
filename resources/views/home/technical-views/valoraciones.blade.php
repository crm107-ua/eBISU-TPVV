@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Valoraciones')
@section('content')
    <div id="content" class="uicore-content">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script id="uicore-page-transition"></script>
        <div id="primary" class="content-area">
            <article id="post-13" class="post-13 page type-page status-publish hentry">
                <main class="entry-content">
                    <div data-elementor-type="wp-page" data-elementor-id="13" class="elementor elementor-13">
                        <div
                            class="elementor-section elementor-top-section elementor-element elementor-element-38fe679 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="38fe679" data-element_type="section" id="Nosotros"
                            data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                            <div class="elementor-container elementor-column-gap-no" style="color:white;">
                                <div
                                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                    data-id="fb5deb5" data-element_type="column">
                                    <div class="mt-5 elementor-widget-wrap elementor-element-populated">
                                        <section class="reviews-section">
                                            <div style="margin-bottom:50px">
                                                <h1 style="color:white;">Valoraciones
                                                    sobre {{ Auth::user()->name }}</h1>
                                                <h5 style="color:white; display: inline">Valoración media:</h5>
                                                <div class="review-rating"
                                                     style="display: inline; font-size: 1.4em; margin-left: 15px">
                                                    @for($i = 0; $i < 5; $i++)
                                                        @if($i < $averageValoration)
                                                            <i class='bx bxs-star'></i>
                                                        @else
                                                            <i class='bx bx-star'></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            @foreach($valorations as $index => $valoration)
                                                <div style="margin-bottom: 40px">
                                                    <h3 style="color:#FFFFFF; display: inline">
                                                        {{$businessContactNames[$index]}}
                                                        <i>({{$businessNames[$index]}})</i>
                                                    </h3>
                                                    <div class="review-rating"
                                                         style="display: inline; font-size: 1.4em; margin-left: 15px">
                                                        @for($i = 0; $i < 5; $i++)
                                                            @if($i < $valoration->valoration_valoration)
                                                                <i class='bx bxs-star'></i>
                                                            @else
                                                                <i class='bx bx-star'></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <p style="color:#FFFFFF; margin-top: 10px">
                                                        {{$valoration->valoration_comment}}
                                                </div>
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
