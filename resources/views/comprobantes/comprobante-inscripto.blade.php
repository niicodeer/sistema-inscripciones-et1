<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* TODO: Agregar estilos al comprobante */
    </style>
</head>
<body>
    <h1>Inscripción</h1>
    <h3>Código inscripcion: {{$data['cuil'] .date('YmdHis')}}</h3>
    <p><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
    <p><strong>Apellido:</strong> {{ $data['apellido'] }}</p>
    <p><strong>CUIL:</strong> {{ $data['cuil'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['telefono'] }}</p>
    <p><strong>Género:</strong> {{ $data['genero'] }}</p>
    <p><strong>Fecha de Nacimiento:</strong> {{ $data['fecha_nac'] }}</p>

    <p><strong>Turno</strong> {{ $inscripcion['turno'] }}</p>
    <p><strong>Curso:</strong> {{ $inscripcion['curso_inscripto'] }}</p>
    <p><strong>Modalidad:</strong> {{ $inscripcion['modalidad'] }}</p>
    <p><strong>Fecha:</strong> {{ $inscripcion['fecha_inscripcion'] }}</p>
    <p><strong>Condicion:</strong> {{ $inscripcion['condicion_alumno'] }}</p>

</body>
</html>
