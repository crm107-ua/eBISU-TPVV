@extends('dashboard.partials.master')

@section('title', 'eBISU Dashboard - Detalle de Incidencia')

@section('content')
<div class="container-scroller">
    @include('dashboard.layouts.nav-lateral')
    <div class="container-fluid page-body-wrapper">
        @include('dashboard.layouts.nav-superior')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Título: Problema con los pagos por paypal</h4>
                            <p><strong>Creador de la incidencia:</strong> Rafael Perez</p>
                            <p><strong>Empresa:</strong> Atlas SA</p>
                            <p><strong>Fecha:</strong> 12/12/2023</p>
                            <p><strong>Pago asociado:</strong> Concepto de pago relacionado</p>
                            <p><strong>Técnico:</strong> Juan Morales</p>
                            <p><strong>Descripción:</strong> Nuestros clientes no pueden realizar los pagos por paypal, la operación siempre se cancela con código de error 646. Estamos trabajando diligentemente para resolver esta situación y garantizar una experiencia de compra sin contratiempos.</p>
                            <p><strong>Archivos adjuntados:</strong> <a href="#">image1.png</a> <a href="#">image2.png</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-4 card p-4">
                        <div id="conversation" class="conversation p-3">

                            <div class="message sent mb-3">
                                <div class="message-header m-2">
                                    <strong>{{ Auth::user()->name }}</strong>
                                </div>
                                <div class="message-body p-2">
                                    Mensaje de prueba 1
                                </div>
                            </div>

                            <div class="message received mb-3">
                                <div class="message-header m-2">
                                    <strong>Juan Morales - Técnico</strong> <span class="status">Online</span>
                                </div>
                                <div class="message-body p-2">
                                    Mensaje de prueba 2
                                </div>
                            </div>

                            <div class="message received mb-3">
                                <div class="message-header m-2">
                                    <strong>Juan Morales - Técnico</strong> <span class="status">Online</span>
                                </div>
                                <div class="message-body p-2">
                                    Mensaje de prueba 3
                                </div>
                            </div>

                            <div class="message sent mb-3">
                                <div class="message-header m-2">
                                    <strong>{{ Auth::user()->name }}</strong>
                                </div>
                                <div class="message-body p-2">
                                    Mensaje de prueba 4
                                </div>
                            </div>

                        </div>
                        <div class="send-message-form d-flex mt-3">
                            <textarea class="form-control me-2" placeholder="Escribe un mensaje"></textarea>
                            <button type="button" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        // Realiza un scroll hasta el final de la conversacion
        var conversationContainer = document.getElementById('conversation');
        conversationContainer.scrollTop = conversationContainer.scrollHeight;
    }
</script>