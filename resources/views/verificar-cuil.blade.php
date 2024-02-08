@extends('layouts.forms-layout')

@section('title', 'Formulario Preinscripción')

@section('content')
    <div class="px-2 w-[60%] mx-auto">
        <div>
            <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Inscripciones 2024</h1>
            <p class="text-base text-center text-[#202020]">Ingrese su número de CUIL para comprobar si se encuentra
                pre-inscripto</p>
        </div>
        <form class="flex flex-col gap-y-14 mt-6 items-center w-full" action="{{ route('verificar-cuil') }}" method="POST">
            @csrf
            <div class="w-full flex flex-col gap-2">
                <label for="cuil" class="text-[#2D3648] font-semibold text-sm">CUIL</label>
                <input class="border border-gray-300 p-2 rounded h-10" id= "cuil" name= "cuil"
                    placeholder="20-12345678-2" />
                @error('cuil')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div id="mensaje" class="bg-[#93F844] rounded-lg p-2 text-center w-full hidden"></div>
            <x-primary-button text="Comprobar" id="btn-comprobar" />
            <a href="{{route("inscripcion")}}"
                class="p-4 text-base font-bold text-center text-[#202020] bg-[#EA9010] max-w-80 w-full rounded-md hover:bg-opacity-80 shadow-md hidden"
                id="btn-continuar">
                Continuar
            </a>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const mensajeDiv = document.getElementById('mensaje');
        const btnComprobar = document.getElementById('btn-comprobar');
        const btnContinuar = document.getElementById('btn-continuar');


        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    mensajeDiv.innerHTML = data.mensaje;
                    mensajeDiv.style.backgroundColor = data.encontrado ? '#93f844' : '#f25b50';
                    mensajeDiv.classList.remove('hidden');
                    if (data.encontrado) {
                        btnComprobar.classList.add('hidden');
                        btnContinuar.classList.remove('hidden');
                    }
                });
        });
    });
</script>
