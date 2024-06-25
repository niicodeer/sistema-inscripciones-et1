<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante Pre-inscripción {{ date('Y') + 1 }}</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            padding: 2rem;
        }
        h2 {
            margin: 3rem 0;
            text-align: center;
            font-size: 24px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .td{
            padding: 8px; border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    @include('comprobantes.comprobante-header')

    <h2>Comprobante Preinscripción Ciclo Lectivo {{ date('Y') + 1 }}</h2>
    <table class="header-table">
        <tr>
            <td class="td"><strong>Código preinscripción:</strong></td>
            <td class="td">{{ $preinscripto['cuil'] . date('YmdHis') }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Nombre:</strong></td>
            <td class="td">{{ $preinscripto['nombre'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Apellido:</strong></td>
            <td class="td">{{ $preinscripto['apellido'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>CUIL:</strong></td>
            <td class="td">{{ $preinscripto['cuil'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Email:</strong></td>
            <td class="td">{{ $preinscripto['email'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Teléfono:</strong></td>
            <td class="td">{{ $preinscripto['telefono'] }}</td>
        </tr>
    </table>

</body>

</html>
