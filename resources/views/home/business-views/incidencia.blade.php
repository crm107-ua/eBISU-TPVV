@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Incidencia')
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
                                <div class="elementor-container elementor-column-gap-no" style="width: 100%">
                                    <div
                                        class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
                                        data-id="fb5deb5" data-element_type="column" style="width: 100%">
                                        <div class="elementor-element-populated" style="width: 100%">
                                            <div
                                                class="elementor-element-populated d-flex justify-content-between align-items-center">
                                                <h2 style="color: white;"
                                                    class="mt-5 flex-grow-1">{{$ticket->title}}</h2>
                                                @if($ticket->technitian_id != null)
                                                    <h5 style="color: white" class="mt-5 flex-shrink-1">Te
                                                        atiende: {{$ticket->technitian->user->name}}</h5>
                                                @endif
                                            </div>
                                            <p style="color: white;" class="mt-2"><strong>Concepto de pago
                                                    asociado: </strong><i>{{$ticket->transaction->concept}}</i></p>
                                            <p style="color: white;" class="mt-2">
                                                <strong>Fecha: </strong>
                                                <i>{{date('d-m-Y', strtotime($ticket->creation_date))}}</i></p>
                                            <p style="color: white;" class="mt-2">
                                                <strong>Estado: </strong>
                                                <i>{{strtoupper($ticket->state)}}</i></p>
                                            <p style="color: white;" class="mt-2"><strong>Descripción</strong></p>
                                            <p style="color: white;" class="mt-2"><i>{{$ticket->description}}</i></p>
                                            @if($ticket->attachment != null)
                                                <p style="color: white;" class="mt-2"><strong>Archivos adjuntos</strong>
                                                    <a style="margin-left: 8px"
                                                       href="{{route('downloadFile', $ticket->attachment_id)}}"><i
                                                            class="fas fa-paperclip"></i></a></p>
                                                </p>
                                            @endif
                                            @if($ticket->state == \App\Enums\TicketStateType::Closed->value && $ticket->valoration_valoration != 0)

                                                <label
                                                    style="display: inline; color: white;margin-top: 30px; margin-right: 20px;"><strong>Valoración</strong></label>
                                                <div style="display: inline;">
                                                    <i class="fa{{$ticket->valoration_valoration > 0 ? 's' : 'r'}} fa-star"
                                                       style="color: {{$ticket->valoration_valoration > 0 ? '#FFD700' : '#FFFFFF'}}; font-size: 1.5em;"></i>
                                                    <i class="fa{{$ticket->valoration_valoration > 1 ? 's' : 'r'}} fa-star"
                                                       style="color: {{$ticket->valoration_valoration > 1 ? '#FFD700' : '#FFFFFF'}}; font-size: 1.5em;"></i>
                                                    <i class="fa{{$ticket->valoration_valoration > 2 ? 's' : 'r'}} fa-star"
                                                       style="color: {{$ticket->valoration_valoration > 2 ? '#FFD700' : '#FFFFFF'}}; font-size: 1.5em;"></i>
                                                    <i class="fa{{$ticket->valoration_valoration > 3 ? 's' : 'r'}} fa-star"
                                                       style="color: {{$ticket->valoration_valoration > 3 ? '#FFD700' : '#FFFFFF'}}; font-size: 1.5em;"></i>
                                                    <i class="fa{{$ticket->valoration_valoration > 4 ? 's' : 'r'}} fa-star"
                                                       style="color: {{$ticket->valoration_valoration > 4 ? '#FFD700' : '#FFFFFF'}}; font-size: 1.5em;"></i>
                                                </div>
                                                @if($ticket->valoration_comment != null)
                                                    <p style=" border: 1px #a3b54b solid;
                                                    padding: 20px; border-radius: 10px; margin-top: 10px; margin-bottom: 30px; width: 100%; color: white">
                                                        <i>{{$ticket->valoration_comment}}</i></p>
                                                @endif
                                            @endif
                                            <hr style="border-bottom: 1px white solid; margin-top: 20px; margin-bottom: 40px;">
                                            @foreach($comments as $comment)
                                                <div
                                                    style="background-color: #f0f0f0; padding: 20px; border-radius: 8px; margin-top: 20px; position: relative;">
                                                    <p style="color: black;"><strong>
                                                            @if($comment->author instanceof \App\Models\Business)
                                                                {{$comment->author->contact_info_name}}
                                                            @else
                                                                {{$comment->author->name}}
                                                            @endif
                                                            -
                                                            @if($comment->author_id == Auth::id())
                                                                (Yo)
                                                            @elseif($comment->author->role == \App\Enums\UserRole::Technician->value)
                                                                Técnico
                                                            @elseif($comment->author->role == \App\Enums\UserRole::Admin->value)
                                                                Admin
                                                            @else
                                                                Empresa
                                                            @endif
                                                        </strong>
                                                        @if($comment->attachment != null)
                                                            <a style="margin-left: 8px"
                                                               href="{{route('downloadFile', $comment->attachment_id)}}"><i
                                                                    class="fas fa-paperclip"></i></a>
                                                        @endif
                                                    </p>
                                                    <p style="color: black;">
                                                        {{$comment->message}}
                                                    </p>

                                                    <span
                                                        style="position: absolute; bottom: 10px; right: 20px; color: black;">
                                                        {{ date('d-m-Y H:i', strtotime($comment->sent_date)) }}
                                                    </span></div>
                                            @endforeach

                                            @if($ticket->state != \App\Enums\TicketStateType::Closed->value)
                                                <div style="margin-top: 20px;">
                                                    <label for="new-comment"
                                                           style="display: block; color: white;"><strong>Mensaje</strong></label>
                                                    <textarea id="new-comment" rows="2"
                                                              style="padding: 20px; border-radius: 8px; margin-top: 10px; width: 100%;"
                                                              placeholder="Escribe un comentario aqui"></textarea>
                                                    <button type="button"
                                                            style="padding: 10px; border-radius: 8px; margin-top: 10px; width: 100%;">
                                                        Añadir comentario
                                                    </button>
                                                </div>
                                            @elseif($ticket->valoration_valoration == 0)
                                                <div style="margin-top: 80px;">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <form method="post"
                                                          action="{{route('valorateTicket', $ticket->id)}}">
                                                        @csrf
                                                        <label for="comment"
                                                               style="display: block; color: white;"><strong>Opinión</strong></label>
                                                        <textarea id="comment" rows="2"
                                                                  name="comment"
                                                                  style="padding: 20px; border-radius: 8px; margin-top: 10px; margin-bottom: 30px; width: 100%;"
                                                                  placeholder="Escribe un comentario aqui"></textarea>

                                                        <label for="valoration"
                                                               style="display: inline; color: white;margin-top: 30px; margin-right: 20px;"><strong>Valoración*</strong></label>
                                                        <input type="number" name="valoration"
                                                               style="display: none" value="0" required>
                                                        <div style="display: inline;">
                                                            <i id="star1" onclick="valorationTo(1)" class="far fa-star"
                                                               style="color: #FFD700; font-size: 1.5em; cursor: pointer;"></i>
                                                            <i id="star2" onclick="valorationTo(2)" class="far fa-star"
                                                               style="color: #FFD700; font-size: 1.5em; cursor: pointer;"></i>
                                                            <i id="star3" onclick="valorationTo(3)" class="far fa-star"
                                                               style="color: #FFD700; font-size: 1.5em; cursor: pointer;"></i>
                                                            <i id="star4" onclick="valorationTo(4)" class="far fa-star"
                                                               style="color: #FFD700; font-size: 1.5em; cursor: pointer;"></i>
                                                            <i id="star5" onclick="valorationTo(5)" class="far fa-star"
                                                               style="color: #FFD700; font-size: 1.5em; cursor: pointer;"></i>
                                                        </div>

                                                        <span style="color: white;margin-top: 30px; display: block">*campo requerido</span>
                                                        <button type="submit"
                                                                style="padding: 10px; border-radius: 8px; margin-top: 10px; width: 100%; font-size: 1.4em !important;">
                                                            Valorar
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
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
    <script>
        function valorationTo(valoration) {
            document.getElementsByName('valoration')[0].value = valoration;
            var star;
            for (let i = 1; i <= 5; i++) {
                star = document.getElementById('star' + i);
                star.classList.remove('fas');
                star.classList.add('far');
                star.style.color = '#ffffff';
            }
            for (let i = 1; i <= valoration; i++) {
                star = document.getElementById('star' + i);
                star.classList.remove('far');
                star.classList.add('fas');
                star.style.color = '#FFD700';
            }
            document.getElementsByName('valoration')[0].value = valoration;
        }
    </script>
@endsection
