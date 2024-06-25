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
    <h1>Preinscripción</h1>
    <h3>Código preinscripcion: {{$preinscripto['cuil'] .date('YmdHis')}}</h3>
    <p><strong>Nombre:</strong> {{ $preinscripto['nombre'] }}</p>
    <p><strong>Apellido:</strong> {{ $preinscripto['apellido'] }}</p>
    <p><strong>CUIL:</strong> {{ $preinscripto['cuil'] }}</p>
    <p><strong>Email:</strong> {{ $preinscripto['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $preinscripto['telefono'] }}</p>
    <p><strong>Género:</strong> {{ $preinscripto['genero'] }}</p>
    <p><strong>Fecha de Nacimiento:</strong> {{ $preinscripto['fecha_nac'] }}</p>
</body>
</html>
