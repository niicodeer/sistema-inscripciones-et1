<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }

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
    class="w-full h-full min-h-screen bg-gradient-to-t from-[rgba(62,86,34,1)] to-[rgba(47,117,15,0.1)] flex justify-center items-center pt-10 py-10">
    <div class="bg-white max-w-[80%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-7 md:p-16">
        {{ $slot }}
    </div>
    <script>
        // Obtener el botón para abrir el modal
        var openModalBtn = document.getElementById("openModalBtn");

        // Obtener el modal
        var modal = document.getElementById("myModal");

        // Obtener el botón para cerrar el modal
        var closeModalBtn = document.getElementsByClassName("close")[0];

        // Cuando se haga clic en el botón, abrir el modal
        openModalBtn.onclick = function() {
            modal.style.display = "flex";
        }

        // Cuando se haga clic en la X, cerrar el modal
        closeModalBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario haga clic en cualquier parte fuera del modal, cerrarlo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
{{--     @livewireScripts
    <script>
        Livewire.on('errorOccurred', ({ message }) => {
            alert(message); // Puedes cambiar esto por cualquier lógica de manejo de errores que desees
        });
    </script> --}}
</body>

</html>
