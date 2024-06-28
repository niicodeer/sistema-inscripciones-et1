<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIA - ETN1</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href={{ asset('css/app.css') }}>

    </head>

    <body class="bg-gradient">
        <div class="inner-container">
        <h1 class="title">ESCUELA TÉCNICA Nº 1</h1>
        <div class="links-container">
            <a href="{{ route('preinscripcion') }}" class="link">Preinscripción {{ date('Y') + 1 }}</a>
            <a href="{{ route('verificar-cuil') }}" class="link">Inscripción {{ date('Y') + 1 }}</a>
        </div>
        </div>
        <footer><p>Desarrollado por Alumnos del Instituto Tecnológico Santiago del Estero - 2024</p></footer>
    </body>
</html>
