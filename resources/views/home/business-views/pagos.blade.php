@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Pagos')
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
                                        <div
                                            class="elementor-element elementor-element-70b0e81 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor"
                                            data-id="70b0e81" data-element_type="widget"
                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container mt-5">
                                                <div class="elementor-widget-container mt-5"
                                                     style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h2 style="text-align:center; color:white;" class="mb-4">Historial
                                                        de pagos</h2>
                                                    <form method="GET" action="{{ route('payments') }}">
                                                        <div style="display: flex; gap: 20px;">
                                                            <select name="state"
                                                                    style="padding-right: 55px; padding-left: 25px; height: 40px; background-color: white; color: black; border-radius: 8px;">
                                                                <option
                                                                    value="" {{ old('state') == '' ? 'selected' : '' }}>
                                                                    ESTADO
                                                                </option>
                                                                @foreach(\App\Enums\TransactionStateType::cases() as $value)
                                                                    <option
                                                                        value="{{ $value }}" {{ old('state') == $value->value ? 'selected' : '' }}>
                                                                        {{ strtoupper($value->value) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="date" name="emision_date"
                                                                   value="{{ old('emision_date') }}"
                                                                   style="padding-right: 10px; padding-left: 25px; height: 40px; background-color: white; color: black; border-radius: 8px;"/>
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
                                                            Concepto
                                                        </th>
                                                        <th style=" padding: 10px 0; color:white;">
                                                            Cantidad
                                                        </th>
                                                        <th style=" padding: 10px 0; color:white;">
                                                            Estado
                                                        </th>
                                                        <th style=" padding: 10px 0; color:white;">
                                                            Nº Factura
                                                        </th>
                                                        <th style=" padding: 10px 0; color:white;">
                                                            Fecha de emisión
                                                        </th>
                                                        <th style=" padding: 10px 0; color:white;">
                                                            Fecha de fin
                                                        </th>
                                                        <th style=" padding: 10px 0; color:white;">
                                                            Acciones
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($payments as $payment)
                                                    <tr>
                                                        <td style="padding: 10px 0; color:white;">{{$payment->concept}}</td>
                                                        <td style="padding: 10px 0; color:white;">{{$payment->amount}} €</td>
                                                        <td style="padding: 10px 0; color:white;">{{strtoupper($payment->state->value)}}</td>
                                                        <td style="padding: 10px 0; color:white;">{{$payment->receipt_number}}</td>
                                                        <td style="padding: 10px 0; color:white;">{{$payment->emision_date}}</td>
                                                        <td style="padding: 10px 0; color:white;">{{$payment->finished_date}}</td>
                                                        <td style="padding: 10px 0; color:white;">
                                                            <a href="{{  route('payment', $payment->id) }}" style="all: unset; cursor: pointer">Ver más</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div style="display: flex; justify-content: center; margin-top: 30px;">
                                                    {{ $payments->links() }}
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
