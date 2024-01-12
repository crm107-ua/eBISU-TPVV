@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Pago')
@section('content')
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

                                    <div style="width: 80%; margin: 100 auto; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; background: #FFF;">
                                        <h2 style="color: #333; text-align: center; margin-bottom: 20px;">¿Necesitas reportar un incidente?</h2>
                                        <h5 style="color: #333; text-align: center; margin-bottom: 30px;"> Contáctanos mediante el siguiente formulario </h5>
                                        <form action="{{route('createReport', $id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div style="margin-bottom: 20px;">
                                                <label for="title" style="font-weight: bold; display: block; margin-bottom: 10px;">Título*</label>
                                                <input type="text" id="title" name="title" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Describe brevemente el problema" required>
                                            </div>
                                            <div style="margin-bottom: 20px;">
                                                <label for="description" style="font-weight: bold; display: block; margin-bottom: 10px;">Descripción*</label>
                                                <textarea id="description" name="description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Escribe tu mensaje" required></textarea>
                                            </div>
                                            <div style="margin-bottom: 20px;">
                                                <label for="attachment" style="font-weight: bold; display: block; margin-bottom: 10px;">Subir archivo</label>
                                                <input type="file" id="attachment" name="attachment" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                                            </div>
                                            <div style="text-align: right;">
                                                <button type="submit" style="background-color: #333; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Enviar</button>
                                            </div>
                                            <div>
                                                <span>
                                                    * campo obligatorio
                                                </span>
                                            </div>
                                        </form>
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
@endsection
