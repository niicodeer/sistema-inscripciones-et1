<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body
    class="w-full h-screen bg-gradient-to-t from-[rgba(62,86,34,1)] to-[rgba(47,117,15,0.1)] flex justify-center items-center pt-10">
    <div class="bg-white max-w-[80%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-7 md:p-16">
        @yield('content')
    </div>
</body>

</html>
