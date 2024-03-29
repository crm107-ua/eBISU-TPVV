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
                                                @if(Auth::user()->role == \App\Enums\UserRole::Business)
                                                    <a href="{{ route('report', $payment->id) }}"
                                                       style="all: unset; background-color: #FFFFFF; color: #0f302d; padding: 15px 20px 15px 20px ;
                                               border-radius: 8px; position: absolute; right: 0; top: -15%; cursor: pointer">
                                                        Crear incidencia
                                                    </a>
                                                @endif
                                            </div>
                                            <div style="border: 1px solid white; border-radius: 10px; padding: 25px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px; color:white;">
                                                    <div>
                                                        <p>Concepto: {{$payment->concept == null ? 'Sin concepto' : $payment->concept}}</p>
                                                        <p>Cantidad: {{$payment->amount}} €</p>
                                                        <p>Estado: {{strtoupper($payment->state->value)}}</p>
                                                    </div>
                                                    <div>
                                                      <p>Número de factura:
                                                        @if($payment->receipt_number)
                                                        {{ $payment->receipt_number }}
                                                        @else
                                                          <i>Sin factura</i>
                                                        @endif
                                                      </p>
                                                        <p>Fecha de emisión: <span data-date="{{$payment->emision_date}}"></span></p>
                                                        <p>
                                                          Fecha de finalización:
                                                          @if($payment->finished_date)
                                                              <span data-date="{{$payment->finished_date}}"></span>
                                                          @else
                                                             <i>Sin terminar</i>
                                                          @endif
                                                        </p>
                                                    </div>
                                                </div>
                                              @if($payment->finalize_reason != null)
                                                <p style="color:white;">Razón de
                                                  finalización: {{str_replace('_', ' ', $payment->finalize_reason->name)}}</p>
                                              @endif
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
