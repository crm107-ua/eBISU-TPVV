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
                        <div class="row">
                          <div class="col d-flex justify-content-between">
                            <h4 class="card-title">Título: {{$ticket->title}}</h4>
                            <a href="{{ route('admin.tickets') }}" class="btn btn-primary">Volver</a>
                          </div>
                        </div>
                            <p><strong>Creador de la incidencia:</strong> {{$ticket->transaction->business->contact_info_name}}</p>
                            <p><strong>Empresa:</strong> {{$ticket->transaction->business->user->name}}</p>
                            <p><strong>Fecha:</strong> {{$ticket->creation_date}}</p>
                            <p><strong>Pago asociado:</strong> {{$ticket->transaction->concept}}</p>
                            <p><strong>Técnico:</strong> {{$ticket->technitian->user->name}}</p>
                            <p><strong>Descripción:</strong> {{$ticket->description}}</p>
                            <p><strong>Archivos adjuntados:</strong>
                              @foreach($ticket->attachment) @endforeach
                              <a href="#">image1.png</a></p>
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
<style>
  .btn {
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
<script>
    window.onload = function() {
        // Realiza un scroll hasta el final de la conversacion
        var conversationContainer = document.getElementById('conversation');
        conversationContainer.scrollTop = conversationContainer.scrollHeight;
    }
</script>
