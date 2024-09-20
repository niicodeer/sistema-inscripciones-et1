<!DOCTYPE html>
<html lang="es" @yield('html-style')>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/etn1-logo-wbk.png') }}">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient" data-success="{{ session('success') }}" data-error="{{ session('error') }}">
    <div class="bg-white max-w-[80%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-10 md:p-16 shadow-xl">
        @yield('content')
    </div>

    <footer>
        <p>Desarrollado por Alumnos del Instituto Tecnológico Santiago del Estero - 2024</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
    @yield('scripts')
</body>

</html>
