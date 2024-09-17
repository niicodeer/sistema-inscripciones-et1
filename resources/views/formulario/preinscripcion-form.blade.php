@extends('layouts.forms-layout')
@section('title', 'Formulario Preinscripción')
@section('content')
<div class="px-2">
    <div>
        <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Pre-Inscripción Ciclo Lectivo
            {{ date('Y') + 1 }}</h1>
        <p class="text-base text-center md:text-left text-[#202020] font-semibold">Completa los siguientes datos del
            alumno para registrar su
            pre-inscripción:</p>
    </div>
    <form class="flex flex-col gap-y-14 mt-6 items-center" action="{{ route('preinscripcion') }}" method="POST">
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

        <x-primary-button text="Finalizar" />
    </form>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            clearErrors();
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const cuil = document.getElementById('cuil').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const genero = document.getElementById('genero').value;
            const fechaNac = document.getElementById('fecha_nac').value;
            const condicionPreinscripcion = document.querySelectorAll(
                'input[name="condicion_preinscripcion"]');
            const declaracionJurada = document.getElementById('declaracion_jurada').checked;

            let isValid = true;

            if (!nombre || nombre.length < 3 || nombre.length > 20) {
                showError('nombre', 'El nombre debe tener entre 3 y 20 caracteres');
                isValid = false;
            }

            if (!apellido || apellido.length < 3 || apellido.length > 20) {
                showError('apellido', 'El apellido debe tener entre 3 y 20 caracteres');
                isValid = false;
            }

            const cuilRegex = /^[0-9]{11}$/;
            if (!cuil || !cuilRegex.test(cuil)) {
                showError('cuil', 'El CUIL debe contener 11 números válidos');
                isValid = false;
            }

            if (!genero || !['Femenino', 'Masculino', 'Otro'].includes(genero)) {
                showError('genero', 'Debe seleccionar un género válido');
                isValid = false;
            }

            if (!fechaNac || !isValidDate(fechaNac)) {
                showError('fecha_nac', 'Debe proporcionar una fecha de nacimiento válida');
                isValid = false;
            } else {
                const age = calculateAge(fechaNac);
                if (age < 12 || age > 17) {
                    showError('fecha_nac', 'El alumno debe tener entre 12 y 17 años');
                    isValid = false;
                }
            }

            if (email && (email.length < 10 || email.length > 100 || !validateEmail(email))) {
                showError('email',
                    'El email debe ser una dirección válida con entre 10 y 100 caracteres');
                isValid = false;
            }

            const telefonoRegex = /^[0-9\s\-]+$/;
            if (!telefono || telefono.length < 8 || telefono.length > 15 || !telefonoRegex.test(
                    telefono)) {
                showError('telefono', 'El teléfono debe ser un número válido entre 8 y 15 caracteres');
                isValid = false;
            }

            if (!Array.from(condicionPreinscripcion).some(item => item.checked)) {
            showError('condicion_preinscripcion_error', 'Debe seleccionar una condición de preinscripción');
            isValid = false;
        }

            if (!declaracionJurada) {
                showError('declaracion_jurada', 'Debe aceptar la declaración jurada');
                isValid = false;
            }
            if (!isValid) {
                event.preventDefault();
            }
        });

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidDate(dateString) {
            const date = new Date(dateString);
            return date instanceof Date && !isNaN(date);
        }

        function calculateAge(birthdate) {
            const birthDate = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            field.classList.add('border-red-700');
            const errorElement = document.createElement('p');
            errorElement.classList.add('text-red-700', 'text-sm');
            errorElement.innerText = message;
            field.parentNode.appendChild(errorElement);
        }

        function clearErrors() {
            const errorMessages = document.querySelectorAll('p.text-red-700');
            errorMessages.forEach((msg) => msg.remove());

            const fields = document.querySelectorAll('.border-red-700');
            fields.forEach((field) => field.classList.remove('border-red-700'));
        }
    });
</script>
@endsection
