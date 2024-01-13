@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Pago')
@section('content')
    <div id="content" class="uicore-content">
        <script id="uicore-page-transition"></script>
        <div id="primary" class="content-area">
            <article id="post-13" class="post-13 page type-page status-publish hentry">
                <main class="entry-content">
                    <div data-elementor-type="wp-page" data-elementor-id="13" class="elementor elementor-13">
                        <div
                            class="elementor-section elementor-top-section elementor-element elementor-element-38fe679 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="38fe679" data-element_type="section" id="Nosotros"
                            data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                            <div class="elementor-container elementor-column-gap-no">
                                <div
                                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                    data-id="fb5deb5" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-widget-container mt-5"
                                             style="width: 90%; margin-bottom: 25%;">
                                            <div style="position: relative; margin-bottom: 20px;margin-top: 40px;">
                                                <h2 style="text-align:center; color:white; padding-bottom: 20px; ">
                                                    Detalles de pago</h2>
                                                <a href="{{ route('report', $payment->id) }}"
                                                   style="all: unset; background-color: #FFFFFF; color: #0f302d; padding: 15px 20px 15px 20px ;
                                               border-radius: 8px; position: absolute; right: 0; top: -15%; cursor: pointer">
                                                    Crear incidencia
                                                </a>
                                            </div>
                                            <div style="border: 1px solid white; border-radius: 10px; padding: 25px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px; color:white;">
                                                    <div>
                                                        <p>Concepto: {{$payment->concept}}</p>
                                                        <p>Cantidad: {{$payment->amount}} €</p>
                                                        <p>Estado: {{strtoupper($payment->state)}}</p>
                                                    </div>
                                                    <div>
                                                        <p>Número de factura: {{$payment->receipt_number}}</p>
                                                        <p>Fecha de emisión: {{$payment->emision_date}}</p>
                                                        <p>Fecha de finalización: {{$payment->finished_date}}</p>
                                                    </div>
                                                </div>
                                                <p style="color:white;">Razón de
                                                    finalización: {{str_replace('_', ' ', \App\Enums\FinalizeReason::from($payment->finalize_reason)->name)}}</p>
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
