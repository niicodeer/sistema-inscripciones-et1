<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIA - ETN1</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <link rel="icon" href="{{ asset('images/etn1-logo-wbk.png') }}">

</head>

<body class="bg-gradient">
    <div class="inner-container">
        <h1 class="title ">ESCUELA TÉCNICA <br>Nº 1</h1>
        <div class="links-container">
            @if ($preinscripcionHabilitada)
                @if ($diferenciaDiasPreinscripcion > 0)
                    <p>Faltan {{ $diferenciaDiasPreinscripcion }} para que comiencen las preinscripciones.</p>
                @elseif($diferenciaDiasPreinscripcion < 0)
                    <p>La preinscripción de alumnos ha finalizado.</p>
                @else
                    <a href="{{ route('preinscripcion') }}" class="link">Preinscripción {{ date('Y') + 1 }}</a>
                @endif
            @else
                <p>Las preinscripciones no se encuentran habilitadas de momento.</p>
            @endif
            <hr/>
            @if ($inscripcionHabilitada)
                @if ($diferenciaDiasInscripcion > 0)
                    <p>Faltan {{ $diferenciaDiasInscripcion }} para que comiencen las inscripciones.</p>
                @elseif ($diferenciaDiasInscripcion < 0)
                    <p>La inscripción de alumnos ha finalizado.</p>
                @else
                    <a href="{{ route('verificar-cuil') }}" class="link">Inscripción {{ date('Y') + 1 }}</a>
                @endif
            @else
                <p>Las inscripciones no se encuentran habilitadas de momento.</p>
            @endif
        </div>
    </div>
    <footer class="text-center">
        <p>Desarrollado por Alumnos del Instituto Tecnológico Santiago del Estero - 2024</p>
    </footer>
</body>

</html>
