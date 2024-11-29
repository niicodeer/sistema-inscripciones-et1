@extends('layouts.forms-layout')
@section('title', 'Formulario Preinscripción')
@section('content')
<div id="loader-overlay" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white p-6 rounded-lg shadow-xl flex flex-col items-center gap-3">
        <div class="w-12 h-12 border-4 border-[#EA9010] border-t-transparent rounded-full animate-spin"></div>
        <p class="text-gray-700 font-medium">Cargando formulario...</p>
    </div>
</div>
<div class="px-2">
    <div>
        <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Pre-Inscripción Ciclo Lectivo
            {{ date('Y') + 1 }}</h1>
        <p class="text-base text-center md:text-left text-[#202020] font-semibold">Completa los siguientes datos del
            alumno para registrar su
            pre-inscripción:</p>
    </div>
    <form class="flex flex-col gap-y-14 mt-6 items-center" action="{{ route('preinscripcion.store') }}" method="POST">
        @csrf
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
            <x-input type="text" id="cuil" label="Cuil" require
                placeholder="Introduce el cuil sin guiones ni puntos" value="{{ old('cuil') }}" />
            <x-input type="text" placeholder="Nombre" id="nombre" label="Nombre" require
                value="{{ old('nombre') }}" />
            <x-input type="text" id="apellido" label="Apellido" require placeholder="Apellido"
                value="{{ old('apellido') }}" />
            <x-select id="genero" label="Género" require :options="json_encode(['Femenino', 'Masculino', 'Otro'])" />
            <x-input type="date" id="fecha_nac" require label="Fecha Nacimiento" value="{{ old('fecha_nac') }}" />
            <x-input type="email" id="email" label="Email" placeholder="Introduce un correo"
                value="{{ old('email') }}" />
            <x-input type="text" id="telefono" label="Teléfono" require placeholder="Introduce un telefono"
                value="{{ old('telefono') }}" />
            <div>
                <p class="text-[#2D3648] font-semibold text-base mb-4">(<span class="text-red-700 text-sm">*</span>) Por
                    favor, seleccione una opción según corresponda la condicion con la que se pre-inscribe alumnos:</p>
                <x-input-radio id="alumno_familiar" label="Hermano/a de Alumno/Personal de la institución. **"
                    value="alumno familiar" name="condicion_preinscripcion" />
                <x-input-radio id="alumno_general" label="Alumnos en General." value="alumno general"
                    name="condicion_preinscripcion" />
                    <p id="condicion_preinscripcion_error"></p>
                @error('condicion_preinscripcion')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full">
            <p class="text-grey-400 text-left w-full italic text-sm">(<span class="text-red-700">*</span>) Campos
                obligatorios.
                <br>
                (<span class="text-red-700">**</span>) Deberá proporcionar
                los documentos que lo verifique cuando la institucion se lo solicite
            </p>
        </div>
        <div class="mt-4">
            <x-input-check id="declaracion_jurada"
                label="Declaro que la información proporcionada tiene carácter de declaración jurada, y que cualquier
                    falsificación de los datos proporcionados llevará a la anulación de la solicitud." />
        </div>

        <x-primary-button text="Finalizar" id="submitBtn" />
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/preinscripcion-form-scripts.js') }}"></script>
@endsection
