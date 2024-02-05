@extends('layouts.forms-layout')
@section('title', 'Preinscripción correcta')

@section('content')
    <div class="flex flex-col gap-8 justify-center items-center w-full max-w-96">

            <h1 class="text-2xl md:text-3xl font-bold">Registramos tu <br/> pre-inscripción!</h1>
            <p class="">Gracias por pre-inscribirte! En los próximos meses te esteremos avisando las fechas de
                inscripción. ¡Estate
                atento a tu correo y a nuestro perfil de Facebook!</p>


        <div class="flex gap-2 items-center">
            <div>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_96_3094)">
                        <path
                            d="M21.8715 0.905273H2.12965C1.45344 0.905273 0.905273 1.45344 0.905273 2.12965V21.8715C0.905273 22.5477 1.45344 23.0959 2.12965 23.0959H21.8715C22.5477 23.0959 23.0959 22.5477 23.0959 21.8715V2.12965C23.0959 1.45344 22.5477 0.905273 21.8715 0.905273Z"
                            fill="#3D5A98" />
                        <path
                            d="M16.215 23.0943V14.5012H19.0987L19.53 11.1524H16.215V9.01494C16.215 8.04557 16.485 7.38369 17.8743 7.38369H19.6481V4.38369C18.7892 4.29418 17.926 4.25161 17.0625 4.25619C14.5087 4.25619 12.75 5.81244 12.75 8.68307V11.1524H9.86621V14.5012H12.75V23.0943H16.215Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_96_3094">
                            <rect width="24" height="24" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <a href="#" class="underline">Escuela Técnica Nº 1</a>
        </div>
        <div class="flex gap-2 flex-col items-center">
            <x-primary-button text="Descargar comprobante" onclick="mostrarAlerta()"/> {{-- TODO: crear funcion para descargar comprobante pdf --}}
            <x-secondary-button text="Volver al inicio" href="#"/>
        </div>
    </div>
@endsection

<script>
    function mostrarAlerta() {
        alert('¡Haz hecho clic en Descargar comprobante!');
    }
</script>
