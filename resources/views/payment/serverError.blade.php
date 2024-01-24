<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>eBISU - Información de pago</title>
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
            padding: 20px;
            border: 2px solid #ff0000;
            border-radius: 10px;
            background-color: #ffebee;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        .retry-link {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .retry-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>eBISU - Información de pago</h1>
    <div class="error-message">
        <p>Error en el servidor procesando la transacción.</p>
        <a href="{{ route('payment.get.form', ['id' => $transaction->id]) }}" class="retry-link">Volver a intentar</a>
    </div>
</body>

</html>
