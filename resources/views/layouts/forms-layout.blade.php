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

<body
    class="bg-gradient py-8 {{-- w-full h-full min-h-screen bg-gradient-to-t from-[rgba(62,86,34,1)] to-[rgba(47,117,15,0.1)] flex justify-center items-center pt-10 py-10 --}}">
    <div class="bg-white max-w-[80%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-7 md:p-16 shadow-xl">
        {{ $slot }}
    </div>
</body>

</html>
