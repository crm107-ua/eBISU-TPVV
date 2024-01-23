@extends('dashboard.partials.master')

@section('title', 'eBISU Dashboard - Detalle de Incidencia')

@section('content')
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                        <div class="row">
                          <div class="col">
                            <p><strong>Creador de la incidencia:</strong> {{$ticket->transaction->business->contact_info_name}}</p>
                            <p><strong>Empresa:</strong> {{$ticket->transaction->business->user->name}}</p>
                            <p><strong>Fecha:</strong> {{$ticket->creation_date}}</p>
                            <p><strong>Pago asociado:</strong> {{$ticket->transaction->concept}}</p>
                            <div class="d-flex align-items-center">
                              <p class="mb-0"><strong>Técnico:</strong> {{$ticket->technitian->user->name}}</p>
                              <button id="assignButton" class="btn btn-primary" style="margin-left: 10px">
                                @if($ticket->technitian_id == null)
                                  Asignar
                                @else
                                  Reasignar
                                @endif
                              </button>
                              <div id="assignForm" style="display: none; margin-left: 20px">
                                <form action="{{ route('admin.tickets.assign', $ticket->id) }}" method="POST"
                                      class="d-flex align-items-center ml-4">
                                  @csrf
                                  <select id="techID" name="techID">
                                    @foreach($technitians as $technitian)
                                      <option value="{{ $technitian->id }}">{{ $technitian->user->name }}</option>
                                    @endforeach
                                  </select>
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                              </div>
                            </div>
                            <p><strong>Descripción:</strong> {{$ticket->description}}</p>

                            @if($ticket->attachment != null)
                            <p><strong>Archivo adjunto:</strong>
                              <a style="margin-left: 8px"
                                 href="{{route('admin.tickets.download.attachment', $ticket->id)}}">
                                <i class='bx bx-paperclip bx-sm bx-rotate-90'></i></a></p>
                            </p>
                            @endif
                          </div>
                          <div class="col">
                            @if($ticket->valoration_valoration != null)
                            <p><strong>Valoración:</strong>
                                @for($i = 0; $i < 5; $i++)
                                  @if($i < $ticket->valoration_valoration)
                                    <i class='bx bxs-star'></i>
                                  @else
                                    <i class='bx bx-star'></i>
                                  @endif
                                @endfor
                                <br>
                                <strong>Comentario de cliente:</strong> {{$ticket->valoration_comment}}
                            </p>
                            @endif
                          </div>
                        </div>
                            <div class="row">
                                @if(session('error'))
                                  <div class="alert alert-danger">
                                    {{ session('error') }}
                                  </div>
                                @endif

                                @if (session('success'))
                                  <div class="alert alert-success">
                                    {{ session('success') }}
                                  </div>
                                @endif
                            </div>
                        </div>
                    </div>

              </div>
                <div class="row">
                    <div class="mt-4 card p-4">
                      <div id="conversation" class="conversation p-3">
                        @foreach($ticket->comments->sortBy('sent_date') as $comment)
                          @if($comment->author_id == $ticket->technitian_id)
                            <div class="message sent mb-3">
                              <div class="message-header m-2">
                                <strong>{{$comment->author->name}}</strong>
                                @if($comment->attachment != null)
                                  <a style="margin-left: 8px"
                                     href="{{route('downloadFile', $comment->attachment->id)}}">
                                    <i class='bx bx-paperclip bx-sm'></i></a>
                                @else
                                  <p> no hay nada</p>
                                @endif
                              </div>
                              <div class="message-body p-2">
                                {{$comment->message}}
                              </div>
                            </div>
                          @else
                            <div class="message received mb-3">
                              <div class="message-header m-2">
                                <strong>{{$comment->author->name}}</strong>
                                @if($comment->attachment != null)
                                  <a style="margin-left: 8px"
                                     href="{{route('downloadFile', $comment->attachment->id)}}">
                                    <i class='bx bx-paperclip bx-sm'></i></a>
                                @else
                                  <p> no hay nada</p>
                                @endif
                              </div>
                              <div class="message-body p-2">
                                {{$comment->message}}
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                        <!--
                        <div class="send-message-form d-flex mt-3">
                            <textarea class="form-control me-2" placeholder="Escribe un mensaje"></textarea>
                            <button type="button" class="btn btn-primary">Enviar</button>
                        </div>
                        -->
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

        document.getElementById('assignButton').addEventListener('click', function() {
          document.getElementById('assignForm').style.display = 'block';
          document.getElementById('assignButton').style.display = 'none';
        });
    }
</script>
