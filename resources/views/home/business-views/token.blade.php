@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Generar token')
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
                        <div class="elementor-container elementor-column-gap-no" style="margin-bottom: 20%;">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                data-id="fb5deb5" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div style="background-color: #f2f2f2; width: 100%; padding: 20px; border-radius: 8px; margin-top: 120px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        <h3 style="margin-bottom: 20px; text-align: left;">Token de eBISU API</h3>
                                        <div style="background-color: white; padding: 20px; border-radius: 8px;">
                                            <p><strong>Mi token:</strong></p>
                                            <input type="text" value="{{ $encodedToken }}" readonly style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                                            <p>Fecha de expiración: <span {{ $token->expiration_date->isPast() ? 'style=color:red;' : '' }} >{{ $token->expiration_date }}</span></p>
                                            <p>Nº de usos: {{ $token->times_used }}</p>
                                            <p>Nº de usos totales: {{ $totalUses }}</p>
                                            @if($token->invalidated)
                                            <p style="color: red;">Invalidado</p>
                                            @endif
                                            <div style="text-align: right; padding-top: 20px;">
                                                <a href="{{ route('crear-generar-token') }}" style="border: none; padding: 10px 20px; background-color: #333; color: white; border-radius: 4px; cursor: pointer;">Generar nuevo</a>
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
@endsection
