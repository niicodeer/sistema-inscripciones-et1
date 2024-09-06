<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <style>
        .close {
            position: absolute;
            color: #aaaaaa;
            font-size: 32px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

</head>

<body class="bg-gradient py-8">
    <div class="bg-white max-w-[80%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-7 md:p-16 shadow-xl">
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
        @if(session('success'))
            // Alerta de éxito
            Toast.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success',
            });
        @endif

        @if(session('error'))
            // Alerta de error
            Toast.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error',
            });
        @endif
    });
        </script>
<!-- <footer class=""><p>Desarrollado por Alumnos del Instituto Tecnológico Santiago del Estero - 2024</p></footer> -->
</body>

</html>
