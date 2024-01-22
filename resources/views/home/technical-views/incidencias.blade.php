@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Incidencias')
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
                                    <!-- Aquí comienza la tabla de historial de incidencias -->
                                    <div class="elementor-element elementor-element-70b0e81 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor"
                                        data-id="70b0e81" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
                                        data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container mt-5">
                                            <div class="elementor-widget-container mt-5"
                                                 style="display: flex; justify-content: space-between; align-items: center;">
                                            <h2 style="text-align:center; color:white;" class="mb-4">Incidencias de técnico</h2>
                                            <form method="GET" action="{{ route('technician.tickets') }}">
                                                <div style="display: flex; gap: 20px;">
                                                    <select name="state"
                                                            style="padding-right: 55px; padding-left: 25px; height: 40px; background-color: white; color: black; border-radius: 8px;">
                                                        <option
                                                            value="" {{ old('state') == '' ? 'selected' : '' }}>
                                                            ESTADO
                                                        </option>
                                                        @foreach(\App\Enums\TicketStateType::cases() as $value)
                                                            <option
                                                                value="{{ $value }}" {{ old('state') == $value->value ? 'selected' : '' }}>
                                                                {{ strtoupper($value->value) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input name="transaction"
                                                           style=" height: 40px; border-radius: 8px;"
                                                           placeholder="Nº factura" value="{{old('transaction') }}">
                                                    <button type="submit" style="padding: 10px 30px 10px 30px;">
                                                        Filtrar
                                                    </button>
                                                </div>
                                            </form>
                                            </div>
                                            <table
                                                style="width:100%; margin-top:20px; text-align:center; border-collapse: collapse;">
                                                <thead style=" border-bottom: #ffffff 1px solid;">
                                                <tr>
                                                    <th style=" padding: 10px 0; color:white;">
                                                        Titulo
                                                    </th>
                                                    <th style=" padding: 10px 0; color:white;">
                                                        Nº Factura
                                                    </th>
                                                    <th style=" padding: 10px 0; color:white;">
                                                        Estado
                                                    </th>
                                                    <th style=" padding: 10px 0; color:white;">
                                                        Acciones
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tickets as $ticket)
                                                    <tr>
                                                        <td style="padding: 10px 0; color:white;">{{$ticket->title}}</td>
                                                        <td style="padding: 10px 0; color:white;">{{$ticket->transaction->receipt_number}}</td>
                                                        <td style="padding: 10px 0; color:white;">{{strtoupper($ticket->state)}}</td>
                                                        <td style="padding: 10px 0; color:white;">
                                                            <a href="{{  route('ticket', $ticket->id) }}"
                                                               style="all: unset; cursor: pointer">Ver más</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div style="display: flex; justify-content: center; margin-top: 30px;">
                                                {{ $tickets->links() }}
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
