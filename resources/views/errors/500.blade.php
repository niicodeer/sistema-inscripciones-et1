<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Error interno del servidor</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #333;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .error-container {
            max-width: 600px;
        }

        .error-code {
            font-size: 72px;
            font-weight: bold;
        }

        .error-message {
            font-size: 24px;
            margin-top: 20px;
        }

        a {
            font-size: 20px;
            text-decoration: none;
            color: black;
            background-color: #777;
            padding: 16px 32px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <div class="error-message">{{ $exception->getMessage() }}</div>
        <div style="margin: 64px;">
            <x-secondary-button text="Volver" href="{{ route('verificar-cuil') }}" />
        </div>
    </div>
</body>

</html>
