<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>Información de pago finalizado</title>
</head>

<body>
    <div class="container mt-5">
        <h1>eBISU</h1>
        <h2>Información de pago finalizado</h2>
        <h3 style="color: red;">Esta página no es recargable, una vez la cierre no podrá volver a ella</h3>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $business->user->name }}</h5>
                    <p class="card-text">
                        Usted ha realizado un pago a {{ $business->user->name }} por cantidad de
                        <strong>{{ $transaction->amount }}€</strong>.
                    </p>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h5>Concepto de transacción</h5>
                                <p class="card-text">
                                    @if ($transaction->concept)
                                        {{ $transaction->concept }}
                                    @else
                                        <i>{{ $business->user->name }} no ha indicado un concepto al solicitar la
                                            transacción.</i>
                                    @endif
                                </p>
                                <br>
                            </div>
                            <div class="col">
                                <h5>Factura de transacción</h5>
                                <p class="card-text">
                                    @if ($transaction->receipt_number)
                                        {{ $transaction->receipt_number }}
                                    @else
                                        <i>{{ $business->user->name }} no ha indicado una factura al solicitar la
                                            transacción.</i>
                                    @endif
                                </p>
                                <br>
                            </div>
                        </div>
                    </div>
                    <p class="card-text">
                        Si considera que ha habido un error, puede ponerse en contacto con dicha empresa en el correo
                        <a href="mailto:"{{ $business->contact_info_email }}>{{ $business->contact_info_email }}</a>.
                    </p>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Estado de la transacción</h5>
                    @if ($transaction->state === \App\Enums\TransactionStateType::Waiting)
                        <p class="card-text">Aún se está procesando</p>
                    @else
                        <h6 class="card-subtitle mb-2 text-muted">Finalizada el {{ $transaction->finished_date }}</h6>
                        <p class="card-text">
                            @if ($transaction->finalize_reason === \App\Enums\FinalizeReason::OK)
                                Finalizada con éxito
                            @elseif ($transaction->finalize_reason === \App\Enums\FinalizeReason::INSUFFICIENT_BALANCE)
                                Finalizada debido a saldo insuficiente
                            @elseif ($transaction->finalize_reason === \App\Enums\FinalizeReason::TIMEOUT)
                                Finalizada debido a tiempo de espera agotado
                            @elseif ($transaction->finalize_reason === \App\Enums\FinalizeReason::INVALID_PAYMENT_INFORMATION)
                                Finalizada debido a información de pago inválida
                            @elseif ($transaction->finalize_reason === \App\Enums\FinalizeReason::CANCELLED)
                                Transacción cancelada
                            @endif
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <h6><i>¿Qué es esto?</i></h6>
        <p>
            Se encuentra en la página de resultado de pagos de <a href={{ route('home') }}>eBISU</a> comporbando un
            pago
            realizado a
            {{ $business->user->name }}.
        </p>
    </div>
</body>

</html>
