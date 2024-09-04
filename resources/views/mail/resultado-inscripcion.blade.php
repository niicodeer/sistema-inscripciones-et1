<!DOCTYPE html>
<html lang="es" style="font-family: sans-serif; font-size: 14px; max-width: 1280px; margin: 0 auto">

<head>
    <title>Estado Inscripcion {{ date('Y') + 1 }}</title>
    <style>
        @media (min-width: 768px) {
            html {
                font-size: 18px;
            }
        }
    </style>
</head>

<body style="width: 100%; padding: 1rem; box-sizing: border-box; margin: 0 auto; max-width: 1280px;">
    <div style=" width: 100%; display: block; padding: 2rem 0;color:#eee ">
        <img src="{{ asset('images/etn1-logo.jpg') }}" alt="logo" style="display: block; margin: auto;" width="150">
    </div>
    <div style="width: 90%; background-color: #fff; display: block; margin:auto; max-width: 800px;" class="content">
        <h1 style="font-size: 2rem">Resultado de tu inscripción en <i style="color: #fe5500">Escuela Técnica Nº 1</i>
        </h1>
        </br>
        <h3 style="font-size: 1.5rem; font-weight: 400">Hola, {{ $data->estudiante->fullname }} 👋</h3>
        <p style="font-size: 1.3rem">El estado de tu solicitud de inscripción para {{ $data->curso_inscripto }} es:
        </p>
        <div style="background-color: #ddd; padding: 1rem;">
            <p style="font-size: 1.6rem; letter-spacing: 0.2rem; text-align: center;">
                <strong>{{ strtoupper($data->estado_inscripcion) }}</strong>
            </p>
        </div>
        @if ($data->estado_inscripcion == 'aceptado')
            <p style="font-size: 1.3rem">Felicitaciones! Este año tu curso será <strong>
                    {{ $data->curso->fullcurso }}</strong>
                en el turno <i>{{ $data->turno }}</i>
                @if ($data->modalidad)
                    en la modalidad de <i>{{ $data->modalidad }}</i>
                @endif
                .
            </p>
            </br>
            <p style="font-size: 1.3rem; font-style: italic">Te esperamos! <br> Saludos cordiales.</p>
        @else
            </br>
            <p style="font-size: 1.3rem">Lamentablemente, tu solicitud de inscripción no ha sido aceptada.</p>
            <p style="font-size: 1.3rem">Entendemos que esta noticia puede ser decepcionante, pero te alentamos a
                seguir buscando oportunidades y mantenerte en contacto con nosotros para futuras convocatorias.</p>
            </br>
            <p style="font-size: 1.3rem; font-style: italic">Gracias por tu interés en nuestra institución.<br> ¡Te
                deseamos mucho éxito en tu futuro!<br/><br/> Saludos cordiales</p>

        @endif
    </div>
    <footer style="padding: 1rem; margin-top: 5rem">
        <p style="font-size: 1rem; text-align: center; color: #555"><i>SIA - ETN1</i></p>
    </footer>
</body>

</html>

