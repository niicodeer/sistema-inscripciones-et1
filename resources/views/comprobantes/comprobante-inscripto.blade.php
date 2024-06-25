<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante Inscripción {{ date('Y') + 1 }}</title>
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

        .td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    @include('comprobantes.comprobante-header')
    <h2>Comprobante Inscripción Ciclo Lectivo {{ date('Y') + 1 }}</h2>
    <table class="header-table">
        <tr>
            <td class="td"><strong>Código inscripción:</strong></td>
            <td class="td">{{ $data['cuil'] . date('YmdHis') }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Nombre:</strong></td>
            <td class="td">{{ $data['nombre'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Apellido:</strong></td>
            <td class="td">{{ $data['apellido'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>CUIL:</strong></td>
            <td class="td">{{ $data['cuil'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Email:</strong></td>
            <td class="td">{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Teléfono:</strong></td>
            <td class="td">{{ $data['telefono'] }}</td>
        </tr>
        <br>
        <br>
        <tr>
            <td class="td"><strong>Curso elegido:</strong></td>
            <td class="td">{{ $inscripcion['curso_inscripto'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Turno:</strong></td>
            <td class="td">{{ $inscripcion['turno'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Modalidad elegida:</strong></td>
            <td class="td">{{ $inscripcion['modalidad'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Condicion del alumno:</strong></td>
            <td class="td">{{ $inscripcion['condicion_alumno'] }}</td>
        </tr>
        <tr>
            <td class="td"><strong>Fecha de inscripción:</strong></td>
            <td class="td">{{ $inscripcion['fecha_inscripcion'] }}</td>
        </tr>

    </table>

</body>

</html>
