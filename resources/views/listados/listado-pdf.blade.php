<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>
    <style>
        body { font-family: DejaVu Sans; }
        .header { text-align: center; margin-bottom: 20px; }
        .table-container { display: flex; justify-content: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td {  text-align: center; font-size: 12px; }
        .table th { background-color: #f2f2f2; }
        .nombre {padding : 12px ,font-size: 12px, text-align: left; white-space: nowrap; }
        .fecha { width: 20px }

    </style>
</head>
<body>
    <div class="header">
        <h1>Listado de Alumnos - Curso: {{ $curso }}</h1>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th class='nombre'>Nombre</th>
                    @for ($i = 1; $i <= 31; $i++)
                        <th class = "fecha"> {{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $alumno)
                    <tr>
                        <td class="nombre">{{ $alumno->fullname }}</td>
                        @for ($i = 1; $i <= 31; $i++)
                            <td class ="fecha"></td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
