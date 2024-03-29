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
    <title>Información de pago</title>
</head>

<body>
    <div class="container mt-5">
        <h1>eBISU</h1>
        <h2>Información de pago</h2>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $business->user->name }}</h5>
                    <p class="card-text">
                        Usted está realizando un pago a {{ $business->user->name }} por cantidad de
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
                            </div>
                            <div class="col">
                                <h5>Tiempo restante</h5>
                                <p class="card-text">
                                    La transacción caducará el <span data-date="{{ $timeoutDate->toIso8601String() }}"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <p class="card-text">
                        Si considera que ha habido un error, puede ponerse en contacto con dicha empresa en el correo
                        <a href="mailto:"{{ $business->contact_info_email }}>{{ $business->contact_info_email }}</a>.
                    </p>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <form method="POST" action="{{ route('payment.post.form', ['id' => $transaction->id]) }}">
                @csrf
                @if ($errors->has('paymentMethod'))
                    @foreach ($errors->get('paymentMethod') as $error)
                        <div class="alert alert-danger mt-2">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="btn-group" role="group" aria-label="Método de pago">
                    <input type="radio" class="btn-check" tabindex="1" value="paypal" name="paymentMethod"
                        id="payWithPaypalRadio" autocomplete="off"
                        {{ old('paymentMethod') == 'paypal' ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="payWithPaypalRadio">Pagar con PayPal</label>

                    <input type="radio" class="btn-check" tabindex="2" value="credit-card" name="paymentMethod"
                        id="payWithCardRadio" autocomplete="off"
                        {{ old('paymentMethod') === 'credit-card' ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="payWithCardRadio">Pagar con tarjeta</label>
                </div>

                <div class="card mt-4" id="pay_with_paypal" style="display: none">
                    <div class="card-header">
                        Pagar con PayPal
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            @if ($errors->has('paypal_username'))
                                @foreach ($errors->get('paypal_username') as $error)
                                    <span class="alert alert-danger input-group-text mt-2">
                                        {{ $error }}
                                    </span>
                                @endforeach
                            @endif
                            <span class="input-group-text">@</span>
                            <div class="form-floating">
                                <input type="text" maxlength="255" required class="form-control" tabindex="3"
                                    id="paypalName" name="paypal_username" placeholder="Usuario de paypal"
                                    value="{{ old('paypal_username') }}">
                                <label for="paypalName">Nombre de usuario de PayPal</label>
                            </div>
                        </div>
                        <button type="submit" tabindex="4" class="btn btn-success">Pagar con PayPal</button>
                    </div>
                </div>

                <div class="card mt-4" id="pay_with_credit_card" style="display: none">
                    <div class="card-header">
                        Pagar con tarjeta
                    </div>
                    <div class="card-body">
                        <div class="form-row align-items-center">
                            <div class="input-group mb-3">
                                @if ($errors->has('credit_card_number'))
                                    @foreach ($errors->get('credit_card_number') as $error)
                                        <span class="alert alert-danger input-group-text mt-2">
                                            {{ $error }}
                                        </span>
                                    @endforeach
                                @endif
                                <div class="form-floating">
                                    <input type="text" maxlength="255" required class="form-control" tabindex="3"
                                        id="creditCardNumber" name="credit_card_number" placeholder="Número de tarjeta"
                                        value="{{ old('credit_card_number') }}">
                                    <label for="creditCardNumber">Número de tarjeta</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    @if ($errors->has('credit_card_month_of_expiration'))
                                        @foreach ($errors->get('credit_card_month_of_expiration') as $error)
                                            <span class="alert alert-danger input-group-text mt-2">
                                                {{ $error }}
                                            </span>
                                        @endforeach
                                    @endif
                                    <div class="form-floating">
                                        <input type="number" min="1" max="12" step="1" required
                                            class="form-control" tabindex="4" id="creditCardExpirationMonth"
                                            name="credit_card_month_of_expiration" placeholder="##"
                                            value="{{ old('credit_card_month_of_expiration') }}">
                                        <label for="creditCardExpirationMonth">Mes de expiración de la tarejeta</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    @if ($errors->has('credit_card_year_of_expiration'))
                                        @foreach ($errors->get('credit_card_year_of_expiration') as $error)
                                            <span class="alert alert-danger input-group-text mt-2">
                                                {{ $error }}
                                            </span>
                                        @endforeach
                                    @endif
                                    <div class="form-floating">
                                        <input type="number" min="1970" max="9999" step="1" required
                                            class="form-control" tabindex="5" id="creditCardExpirationYear"
                                            name="credit_card_year_of_expiration" placeholder="####"
                                            value="{{ old('credit_card_year_of_expiration') }}">
                                        <label for="creditCardExpirationYear">Año de expiración de la tarejeta</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    @if ($errors->has('credit_card_csv'))
                                        @foreach ($errors->get('credit_card_csv') as $error)
                                            <span class="alert alert-danger input-group-text mt-2">
                                                {{ $error }}
                                            </span>
                                        @endforeach
                                    @endif
                                    <div class="form-floating">
                                        <input type="number" min="1" max="999" step="1" required
                                            class="form-control" tabindex="6" id="creditCardCsv"
                                            name="credit_card_csv" placeholder="###"
                                            value="{{ old('credit_card_csv') }}">
                                        <label for="creditCardCsv">CSV</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" tabindex="7" class="btn btn-success">Pagar con tarjeta</button>
                    </div>
                </div>
            </form>
        </div>
        <br />
        <h6><i>¿Qué es esto?</i></h6>
        <p>
            Se encuentra en la página de pagos de <a href={{ route('home') }}>eBISU</a> realizando un pago seguro a
            {{ $business->user->name }}.
        </p>
    </div>
    <script defer>
        window.addEventListener('DOMContentLoaded', (event) => {
            const dateElements = document.querySelectorAll('[data-date]');
            dateElements.forEach(element => {
                const date = new Date(element.dataset.date);
                const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                const options = { timeZone: userTimezone, year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' };
                element.textContent = new Intl.DateTimeFormat('default', options).format(date);
            });
        });

        const paypalInputs = [
            document.getElementById('paypalName'),
        ];
        const creditCardInputs = [
            document.getElementById('creditCardNumber'),
            document.getElementById('creditCardExpirationMonth'),
            document.getElementById('creditCardExpirationYear'),
            document.getElementById('creditCardCsv'),
        ];
        document.querySelectorAll('input[name="paymentMethod"]').forEach(i => i.addEventListener('change', (e) =>
            updateForms(e.target.value)));

        function updateForms(payment) {
            switch (payment) {
                case "paypal":
                    pay_with_paypal.removeAttribute("style");
                    pay_with_credit_card.style.display = 'none';
                    paypalInputs.forEach(i => i.setAttribute('required', 'required'));
                    creditCardInputs.forEach(i => i.removeAttribute('required'));
                    break;
                case "credit-card":
                    pay_with_paypal.style.display = 'none';
                    pay_with_credit_card.removeAttribute("style");
                    paypalInputs.forEach(i => i.removeAttribute('required'));
                    creditCardInputs.forEach(i => i.setAttribute('required', 'required'));
                    break;
            }
        }

        {{ old('paymentMethod') === null ? '' : 'updateForms(`' . old('paymentMethod') . '`);' }}
    </script>
</body>

</html>
