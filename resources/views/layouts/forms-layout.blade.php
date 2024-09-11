<!DOCTYPE html>
<html lang="es" @yield('html-style')>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('images/etn1-logo-wbk.png') }}">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
</head>

<body class="bg-gradient">
    <div class="bg-white max-w-[80%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-10 md:p-16 shadow-xl">
        {{ $slot }}
    </div>

    <footer class="text-center">
        <p>Desarrollado por Alumnos del Instituto Tecnológico Santiago del Estero - 2024</p>
    </footer>
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
            @if (session('success'))
                Toast.fire({
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    icon: 'success',
                });
            @endif

            @if (session('error'))
                Toast.fire({
                    title: 'Error',
                    text: '{{ session('error') }}',
                    icon: 'error',
                });
            @endif
        });
    </script>
</body>

</html>
