<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Información de pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .error-message {
            color: #ff0000;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="error-message">
        <p>Error en el servidor procesando la transacción.</p>
        <a href="{{ route('payment.get.form'. ['id' => $transaction->id]) }}">Volver a intentar</a>
    </div>
</body>
</html>
