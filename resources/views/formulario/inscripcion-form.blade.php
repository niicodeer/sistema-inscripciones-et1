@extends('layouts.forms-layout')
@section('title', 'Formulario Inscripción')
@section('content')
<div class="px-2">
    <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Inscripción Ciclo Lectivo {{ date('Y') + 1 }}
    </h1>
    <h3 class="text-center text-xl my-4" id="step-title">Datos Alumno</h3>

    <!-- Progreso visual del formulario -->
    <div class="flex gap-0.5 w-[80%] mx-auto mt-4 mb-10">
        <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar" id="progress-bar-1"></span></span>
        <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar"
                id="progress-bar-2"></span></span>
        <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar"
                id="progress-bar-3"></span></span>
        <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar"
                id="progress-bar-4"></span></span>
        <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar"
                id="progress-bar-5"></span></span>

    </div>
    <div id="step1-text">
        <p class="text-base text-[#202020] font-semibold">Comprueba los datos de tu pre-inscripción.<br />
            Si están correctos continúa a la siguiente sección o edita/completa algún campo si hace falta.</p>
    </div>

    <form method="POST" class="flex flex-col gap-y-14 mt-6 items-center" id="multiStepForm"
        action="{{ route('inscripcion') }}">
        @csrf
        @method($data['method'])
        {{-- Step 1 --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-1">
            <input type="hidden" name="id_alumno" value="{{ $data['id'] ?? null }}">
            <x-input type="text" id="cuil_alumno" label="Cuil" readonly value="{{ $data['cuil'] }}"
                style="background-color: #e3e3e3" />
            <x-input type="text" id="nombre_alumno" label="Nombre" placeholder="Nombre" require
                value="{{ $data['nombre'] }}" />
            <x-input type="text" id="apellido_alumno" label="Apellido" placeholder="Apellido" require
                value="{{ $data['apellido'] }}" />
            <x-select id="genero_alumno" label="Genero" :options="json_encode(['Femenino', 'Masculino', 'Otro'])" require value="{{ $data['genero'] }}" />
            <x-input type="date" id="fecha_nac_alumno" label="Fecha Nacimiento" require
                value="{{ $data['fecha_nac'] }}" />
            <x-input type="email" id="email_alumno" label="Email" placeholder="Introduce un correo" require
                value="{{ $data['email'] }}" />
            <x-input type="text" id="telefono_alumno" label="Teléfono" placeholder="Introduce un telefono" require
                value="{{ $data['telefono'] }}" />
        </div>
        {{-- Step 2 --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-2" style="display: none;">
            <x-input type="text" id="calle" label="Calle" placeholder="Calle" require
                value="{{ $data['dato']['calle'] ?? '' }}" />
            <div class="w-[45%] flex gap-x-2">
                <x-input type="number" id="numeracion" label="Numeración" placeholder="Numeración" min=0
                    value="{{ $data['dato']['numeracion'] ?? '' }}" />
                <x-input type="text" id="piso" label="Piso dpto" placeholder="Piso"
                    value="{{ $data['dato']['piso'] ?? '' }}" />
            </div>
            <x-input type="text" id="barrio" label="Barrio" placeholder="Barrio" require
                value="{{ $data['dato']['barrio'] ?? '' }}" />
            <x-input type="text" id="provincia" label="Provincia" placeholder="Provincia" require
                value="{{ $data['dato']['provincia'] ?? '' }}" />
            <x-input type="text" id="ciudad" label="Ciudad" placeholder="Ciudad" require
                value="{{ $data['dato']['ciudad'] ?? '' }}" />
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Convive con</p>
                @isset($data['dato']['convivencia'])
                @php
                $convive = json_decode($data['dato']['convivencia'], true) ?? [];
                @endphp
                @endisset
                <div class="w-full grid grid-cols-2 gap-2">
                    <x-input-check id="convive_madre" label="Madre" value="madre" name="convive[]"
                        check="{{ in_array('madre', $convive ?? []) ?? '' }}" />
                    <x-input-check id="convive_padre" label="Padre" value="padre" name="convive[]"
                        check="{{ in_array('padre', $convive ?? []) ?? '' }}" />
                    <x-input-check id="convive_hermanos" label="Hermano/a" value="hermanos" name="convive[]"
                        check="{{ in_array('hermanos', $convive ?? []) ?? '' }}" />
                    <x-input-check id="convive_tios" label="Tia/o" value="tios" name="convive[]"
                        check="{{ in_array('tios', $convive ?? []) ?? '' }}" />
                    <x-input-check id="convive_abuelos" label="Abuela/o" value="abuelos" name="convive[]"
                        check="{{ in_array('abuelos', $convive ?? []) ?? '' }}" />
                    <x-input-check id="convive_otros" label="Otros" value="otros" name="convive[]"
                        check="{{ in_array('otros', $convive ?? []) ?? '' }}" />
                </div>
                @error('convive')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="convive_error"></p>
            </div>
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Medio de transporte</p>
                <div class="w-full grid grid-cols-2 gap-2">
                    @isset($data['dato']['medio_transporte'])
                    @php
                    $transporte = json_decode($data['dato']['medio_transporte'], true) ?? [];
                    @endphp
                    @endisset
                    <x-input-check id="transporte_publico" value="transporte publico" name="transporte[]"
                        label="Trasporte público"
                        check="{{ in_array('transporte publico', $transporte ?? []) ?? '' }}" />
                    <x-input-check id="transporte_auto" value="auto camioneta" name="transporte[]"
                        label="Auto / Camioneta" check="{{ in_array('auto camioneta', $transporte ?? []) ?? '' }}" />
                    <x-input-check id="transporte_moto" value="moto" name="transporte[]" label="Moto"
                        check="{{ in_array('moto', $transporte ?? []) ?? '' }}" />
                    <x-input-check id="transporte_bicicleta" value="bicicleta" name="transporte[]" label="Bicicleta"
                        check="{{ in_array('bicicleta', $transporte ?? []) ?? '' }}" />
                    <x-input-check id="transporte_otro" value="otros" name="transporte[]" label="Otros"
                        check="{{ in_array('otros', $transporte ?? []) ?? '' }}" />
                    <x-input-check id="transporte_no_utiliza" value="no utiliza" name="transporte[]"
                        label="No utiliza" check="{{ in_array('no utiliza', $transporte ?? []) ?? '' }}" />
                </div>
                @error('transporte')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="transporte_error"></p>
            </div>
            <div class=" w-[45%] flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Obra Social / Prepaga</p>
                <div class="flex md:max-w-[45%] w-full gap-6">
                    <x-input-radio id="obra_social_si" label="Si" value="1" name="obra_social"
                        check="{{ ($data['dato']['obra_social'] ?? '') === 1 }}" />
                    <x-input-radio id="obra_social_no" label="No" value="0" name="obra_social"
                        check="{{ ($data['dato']['obra_social'] ?? '') === 0 }}" />
                </div>
                <x-input type="text" id="nombre_obra_social" label="" placeholder="Obra Social / Prepaga"
                    value="{{ $data['dato']['nombre_obra_social'] ?? '' }}" />
                @error('obraSocial')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="obraSocial_error"></p>
            </div>
        </div>
        {{-- Step 3 --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-3" style="display: none;">
            <x-input type="text" id="nombre_tutor" label="Nombre" placeholder="Nombre" require
                value="{{ $data['tutor']['nombre'] ?? '' }}" />
            <x-input type="text" id="apellido_tutor" label="Apellido" placeholder="Apellido" require
                value="{{ $data['tutor']['apellido'] ?? '' }}" />
            <x-input type="text" id="cuil_tutor" label="CUIL" placeholder="Cuil sin guiones ni puntos" require
                value="{{ $data['tutor']['cuil'] ?? '' }}" />
            <x-input type="email" id="email_tutor" label="Email" placeholder="Introduce un correo" require
                value="{{ $data['tutor']['email'] ?? '' }}" />
            <x-input type="text" id="telefono_tutor" label="Teléfono" placeholder="Introduce un telefono" require
                value="{{ $data['tutor']['telefono'] ?? '' }}" />
            <x-input type="text" id="ocupacion_tutor" label="Ocupación" placeholder="Ocupación" require
                value="{{ $data['tutor']['ocupacion'] ?? '' }}" />
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Parentezco</p>
                <div class="grid grid-cols-2">
                    <x-input-radio id="tutor_madre" name="parentezco" label="Madre" value="madre"
                        check="{{ ($data['tutor']['parentezco'] ?? '') === 'madre' }}" />
                    <x-input-radio id="tutor_padre" name="parentezco" label="Padre" value="padre"
                        check="{{ ($data['tutor']['parentezco'] ?? '') === 'padre' }}" />
                    <x-input-radio id="tutor_hermano" name="parentezco" label="Hermano/a" value="hermano"
                        check="{{ ($data['tutor']['parentezco'] ?? '') === 'hermano' }}" />
                    <x-input-radio id="tutor_tio" name="parentezco" label="Tia/o" value="tio"
                        check="{{ ($data['tutor']['parentezco'] ?? '') === 'tio' }}" />
                    <x-input-radio id="tutor_abuelo" name="parentezco" label="Abuela/o" value="abuelo"
                        check="{{ ($data['tutor']['parentezco'] ?? '') === 'abuelo' }}" />
                    <x-input-radio id="tutor_otro" name="parentezco" label="Otro" value="otro"
                        check="{{ ($data['tutor']['parentezco'] ?? '') === 'otro' }}" />
                </div>
                @error('parentezco')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="parentezco_error"></p>
            </div>
        </div>
        {{-- Step 4 --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-4" style="display: none;">
            @isset($data['ultima_inscripcion'])
            @php
            $inscripcion = $data['ultima_inscripcion'];
            @endphp
            @endisset
            <x-select id="curso" label="Seleccione curso" :options="json_encode([
                    'Primer año',
                    'Segundo año',
                    'Tercer año',
                    'Cuarto año',
                    'Quinto año',
                    'Sexto año',
                ])" require
                value="{{ $inscripcion['curso_inscripto'] ?? '' }}" />
            <x-select id="modalidad" label="Modalidad a seguir" :options="json_encode(['Informática', 'Economía', 'Industria'])" {{-- :disabled="in_array(['Primer año', 'Segundo año', ''])"  --}}require
                value="{{ $inscripcion['modalidad'] ?? '' }}" />

            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Condición Alumno</p>
                <div class="flex md:max-w-[45%] w-full gap-x-8">
                    <div class="flex flex-col gap-3">
                        <x-input-radio id="ingresante" label="Ingresante" value="ingresante" name="condicion_alumno"
                            check="{{ ($inscripcion['condicion_alumno'] ?? '') === 'ingresante' }}" />
                        <x-input-radio id="regular" label="Regular" value="regular" name="condicion_alumno"
                            check="{{ ($inscripcion['condicion_alumno'] ?? '') === 'regular' }}" />
                    </div>
                    <div class="flex flex-col gap-3">
                        <x-input-radio id="traspaso" label="Traspaso" value="traspaso" name="condicion_alumno"
                            check="{{ ($inscripcion['condicion_alumno'] ?? '') === 'traspaso' }}" />
                        <x-input-radio id="repitente" label="Repitente" value="repitente" name="condicion_alumno"
                            check="{{ ($inscripcion['condicion_alumno'] ?? '') === 'repitente' }}" />
                    </div>
                </div>
                @error('condicionAlumno')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="condicionAlumno_error"></p>
            </div>

            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Turno</p>
                <div class="flex flex-col md:max-w-[45%] w-full gap-4">
                    <x-input-radio id="mañana" label="Mañana" value="mañana" name="turno"
                        check="{{ ($inscripcion['turno'] ?? '') === 'mañana' }}" />
                    <x-input-radio id="tarde" label="Tarde" value="tarde" name="turno"
                        check="{{ ($inscripcion['turno'] ?? '') === 'tarde' }}" />
                </div>
                @error('turno')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="turno_error"></p>
            </div>
            <x-input type="text" id="escuela_proviene" label="Escuela que proviene" placeholder="Nombre Escuela"
                value="{{ $inscripcion['escuela_proviene'] ?? '' }}" />
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                <div class="flex md:max-w-[45%] w-full gap-6">
                    <x-input-radio id="adeuda_si" label="Si" value="1" name="adeuda_materia"
                        check="{{ ($inscripcion['adeuda_materias'] ?? '') === 1 }}" />
                    <x-input-radio id="adeuda_no" label="No" value="0" name="adeuda_materia"
                        check="{{ ($inscripcion['adeuda_materias'] ?? '') === 0 }}" />
                </div>
                @error('adeudaMaterias')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="adeudaMaterias_error"></p>
                <div class="lg:w-[220%]">
                    <x-input type="text" id="adeuda-materia-nombre" label="" placeholder="Nombres materias"
                        value="{{ $inscripcion['nombre_materias'] ?? '' }}" />
                </div>
            </div>
        </div>
        {{-- Step 5 --}}
        <div id="step-5" style="display: none;" class="step flex-col">
            <p class="text-[#2D3648] font-semibold text-base mb-4">Indique si cumple o no con algunas de las
                siguientes opciones:</p>
            <div class="w-full flex flex-col gap-y-2">
                <x-input-check id="familiar" label="Tengo un familiar que es alumno escuela" value="familiar"
                    name="condicion_inscripcion[]" />
                <x-input-check id="merito" label="Reconocimiento al mérito" value="merito"
                    name="condicion_inscripcion[]" />
                <x-input-check id="otros" label="Otros reconocimientos (concursos, mejor compañero,  etc)"
                    value="otros" name="condicion_inscripcion[]" />
                <x-input-check id="ninguno" label="Ninguno" value="ninguno" name="condicion_inscripcion[]" />
            </div>
            @error('reconocimientos')
            <p class="text-red-700 text-sm">{{ $message }}</p>
            @enderror
            <p id="reconocimientos_error"></p>
            <div class="my-6">
                <p class="text-[#2D3648] italic font-bold text-base">* En caso de cumplir con alguna opción debe
                    presentar en la institución una copia del certificado que lo respalde.</p>
                <p class="text-[#2D3648] italic font-bold text-base">* Además, recuerde que debe proporcionar una
                    foto 4x4 y fotocopia del DNI del inscripto.</p>
            </div>
            <p class="text-[#2D3648] font-semibold text-base pt-6">Por último, indique que está de acuerdo con los
                siguientes términos.</p>
            <div class="w-full flex gap-2 justify-start items-center mt-2">
                <input class="border border-gray-300 p-2 rounded h-5 w-5" id="terminos" name="terminos"
                    type="checkbox">
                <p>
                    Acepto el uso de producciones, imágenes, videos y sonido del alumno
                </p>
                @error('terminos')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror

            </div>
            <div class="w-full flex gap-2 justify-start items-center mt-2">
                <input class="border border-gray-300 p-2 rounded h-5 w-5" id="terminos" name="terminos"
                    type="checkbox">
                <p>
                    He leído y estoy de acuerdo con el <a class='underline' href="{{ route('convivencia.pdf') }}"
                        target="_blank">código de convivencia de la institución</a>

                </p>
                @error('terminos')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <p id="terminos_error"></p>
            </div>
        </div>
        <div class="flex gap-4 w-full justify-center">
            <x-secondary-button text="Volver" href="{{ route('verificar-cuil') }}" id="toVerifyBtn" />
            <x-secondary-button text="Volver" id="prevBtn" class="none" />
            <x-primary-button text="Siguiente" type="button" id="nextBtn" />
            <x-primary-button text="Enviar" type="submit" id="submitBtn" class="none" />
        </div>
    </form>

</div>
@endsection
@section('scripts')
<script>
    let currentStep = 5;
    const form = document.getElementById('multiStepForm');
    const steps = form.querySelectorAll('.step');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const verifyBtn = document.getElementById('toVerifyBtn');
    const submitBtn = document.getElementById('submitBtn');
    let actualStep;

    function showStep(step) {
        if (step === 1) {
            document.getElementById('step1-text').style.display = 'block';
        } else {
            document.getElementById('step1-text').style.display = 'none';
        }
        steps.forEach((element) => {
            element.style.display = 'none';
        });

        actualStep = document.getElementById('step-' + step);
        actualStep.style.display = 'flex';
        actualStep.classList.add('slide-left');

        const titles = ["Datos Alumno", "Datos Alumno", "Datos Tutor", "Selección de curso", "Documentos"];
        document.getElementById('step-title').innerText = titles[step - 1];

        for (let i = 1; i <= 5; i++) {
            const progressBar = document.getElementById('progress-bar-' + i);

            if (i <= step) {
                progressBar.classList.add('animate-progress');
            } else {
                progressBar.classList.remove('animate-progress');
            }
        }

        nextBtn.style.display = step === 5 ? 'none' : 'block';
        prevBtn.style.display = step === 1 ? 'none' : 'block';
        verifyBtn.style.display = step !== 1 ? 'none' : 'block';
        submitBtn.style.display = step !== 5 ? 'none' : 'block';
    }

    function nextStep() {
        if (validateStep(currentStep)) {
            if (currentStep < 5) {
                currentStep++;
                showStep(currentStep);
            }
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        showStep(currentStep);
    });

    prevBtn.addEventListener('click', function() {
        prevStep();
        if (actualStep.classList.contains('slide-left')) {
            actualStep.classList.remove('slide-left');
            actualStep.classList.add('slide-right');
        }
    });

    nextBtn.addEventListener('click', function() {
        nextStep();
        if (actualStep.classList.contains('slide-right')) {
            actualStep.classList.remove('slide-right');
            actualStep.classList.add('slide-left');
        }
    });

    function validateStep(step) {
        let isValid = true;
        document.querySelectorAll('.error').forEach(el => el.remove()); // Elimina mensajes de error previos

        if (step === 1) {
            const nombre = document.querySelector('input[name="nombre_alumno"]');
            if (nombre.value.length < 3 || nombre.value.length > 20) {
                isValid = false;
                showError(nombre, 'El nombre debe tener entre 3 y 20 caracteres.');
            }

            const apellido = document.querySelector('input[name="apellido_alumno"]');
            if (apellido.value.length < 3 || apellido.value.length > 20) {
                isValid = false;
                showError(apellido, 'El apellido debe tener entre 3 y 20 caracteres.');
            }

            const genero = document.querySelector('select[name="genero_alumno"]');
            if (genero.value === '') {
                isValid = false;
                showError(genero, 'Debe seleccionar un género.');
            }

            const fechaNacimientoInput = document.querySelector('input[name="fecha_nac_alumno"]');
            const fechaNacimiento = new Date(fechaNacimientoInput.value);
            const hoy = new Date();
            const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const mes = hoy.getMonth() - fechaNacimiento.getMonth();
            const dia = hoy.getDate() - fechaNacimiento.getDate();
            const email = document.querySelector('input[name="email_alumno"]');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!fechaNacimientoInput.value) {
                isValid = false;
                showError(fechaNacimientoInput, 'El campo fecha de nacimiento es obligatorio.');
            } else if (edad < 12 || (edad === 12 && (mes < 0 || (mes === 0 && dia < 0)))) {
                isValid = false;
                showError(fechaNacimientoInput, 'Debe tener al menos 12 años.');
            }

            if (!emailRegex.test(email.value) || email.value.length < 8 || email.value.length > 100) {
                isValid = false;
                showError(email, 'El email debe ser una dirección válida entre 8 y 100 caracteres.');
            }

            const telefono = document.querySelector('input[name="telefono_alumno"]');
            if (telefono.value.length < 8 || telefono.value.length > 15) {
                isValid = false;
                showError(telefono, 'El teléfono debe tener entre 8 y 15 caracteres.');
            }

        } else if (step === 2) {
            const calle = document.querySelector('input[name="calle"]');
            if (calle.value.length < 5 || calle.value.length > 30) {
                isValid = false;
                showError(calle, 'El campo calle debe tener entre 5 y 30 caracteres.');
            }

            const provincia = document.querySelector('input[name="provincia"]');
            if (!provincia.value) {
                isValid = false;
                showError(provincia, 'El campo provincia es obligatorio.');
            }

            const ciudad = document.querySelector('input[name="ciudad"]');
            if (ciudad.value.length < 5 || ciudad.value.length > 20) {
                isValid = false;
                showError(ciudad, 'El campo ciudad debe tener entre 5 y 20 caracteres.');
            }

            const barrio = document.querySelector('input[name="barrio"]');
            if (barrio.value.length < 5 || barrio.value.length > 20) {
                isValid = false;
                showError(barrio, 'El campo barrio debe tener entre 5 y 20 caracteres.');
            }

            const numeracion = document.querySelector('input[name="numeracion"]');
            if (!numeracion.value || isNaN(numeracion.value)) {
                isValid = false;
                showError(numeracion, 'El campo numeración es obligatorio y debe ser un número.');
            }

            const transporte = document.querySelectorAll('input[name="transporte[]"]:checked');
            if (transporte.length === 0) {
                isValid = false;
                showError(document.getElementById('transporte_error'), 'Debe seleccionar una opción de transporte.');
            }

            const convive = document.querySelectorAll('input[name="convive[]"]:checked');
            if (convive.length === 0) {
                isValid = false;
                showError(document.getElementById('convive_error'), 'Debe seleccionar una opción de convivencia.');
            }

            const obraSocial = document.querySelector('input[name="obra_social"]:checked');
            if (!obraSocial) {
                isValid = false;
                showError(document.getElementById('obraSocial_error'), 'Debe seleccionar si tiene obra social.');
            }

        } else if (step === 3) {
            const nombreTutor = document.querySelector('input[name="nombre_tutor"]');
            if (nombreTutor.value.length < 3 || nombreTutor.value.length > 20) {
                isValid = false;
                showError(nombreTutor, 'El nombre debe tener entre 3 y 20 caracteres.');
            }


            const apellidoTutor = document.querySelector('input[name="apellido_tutor"]');
            if (apellidoTutor.value.length < 3 || apellidoTutor.value.length > 20) {
                isValid = false;
                showError(apellidoTutor, 'El apellido debe tener entre 3 y 20 caracteres.');
            }

            const cuilTutor = document.querySelector('input[name="cuil_tutor"]');
            if (cuilTutor.value.length < 8 || cuilTutor.value.length > 11) {
                isValid = false;
                showError(cuilTutor, 'El CUIL debe tener entre 8 y 11 caracteres.');
            }

            const emailTutor = document.querySelector('input[name="email_tutor"]');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailTutor.value)) {
                isValid = false;
                showError(emailTutor, 'Debe ingresar un correo electrónico válido.');
            }

            const telefonoTutor = document.querySelector('input[name="telefono_tutor"]');
            if (telefonoTutor.value.length < 8 || telefonoTutor.value.length > 15) {
                isValid = false;
                showError(telefonoTutor, 'El teléfono debe tener entre 8 y 15 caracteres.');
            }

            const ocupacionTutor = document.querySelector('input[name="ocupacion_tutor"]');
            if (ocupacionTutor.value.length < 5 || ocupacionTutor.value.length > 30) {
                isValid = false;
                showError(ocupacionTutor, 'La ocupación debe tener entre 5 y 30 caracteres.');
            }

            const parentezco = document.querySelector('input[name="parentezco"]:checked');
            if (!parentezco) {
                isValid = false;
                showError(document.getElementById('parentezco_error'), 'Debe seleccionar una opción de parentezco.');
            }
        } else if (step === 4) {
            const curso = document.querySelector('select[name="curso"]');
            const validCursos = ['Primer año', 'Segundo año', 'Tercer año', 'Cuarto año', 'Quinto año', 'Sexto año'];
            if (!curso.value || !validCursos.includes(curso.value)) {
                isValid = false;
                showError(curso, 'Debe seleccionar un curso válido.');
            }

            const modalidad = document.querySelector('select[name="modalidad"]');
            const validModalidades = ['Informática', 'Economía', 'Industria'];
            if (!modalidad.value || !validModalidades.includes(modalidad.value)) {
                isValid = false;
                showError(modalidad, 'Debe seleccionar una modalidad válida.');
            }

            const condicionAlumno = document.querySelector('input[name="condicion_alumno"]:checked');
            if (!condicionAlumno) {
                isValid = false;
                showError(document.getElementById('condicionAlumno_error'), 'Debe seleccionar una condición para el alumno.');
            }

            const turno = document.querySelector('input[name="turno"]:checked');
            if (!turno) {
                isValid = false;
                showError(document.getElementById('turno_error'), 'Debe seleccionar un turno.');
            }

            const adeudaMaterias = document.querySelector('input[name="adeuda_materia"]:checked');
            if (!adeudaMaterias) {
                isValid = false;
                showError(document.getElementById('adeudaMaterias_error'), 'Debe seleccionar si adeuda materias.');
            }
        } else if (step === 5) {
            const reconocimientos = document.querySelectorAll('input[name="condicion_inscripcion[]"]:checked');
            if (reconocimientos.length === 0) {
                isValid = false;
                showError(document.getElementById('reconocimientos_error'), 'Debe seleccionar al menos una opción.');
            }

            const terminos = document.querySelector('input[name="terminos"]:checked');
            if (!terminos) {
                isValid = false;
                showError(document.getElementById('"terminos_error"'), 'Debe seleccionar que leyó y está de acuerdo.');
            }
        }


        return isValid;
    }

    // Función para mostrar errores de validación
    function showError(input, message) {
        const error = document.createElement('span');
        error.classList.add('error');
        error.style.color = 'red';
        error.textContent = message;
        input.insertAdjacentElement('afterend', error);
    }
    form.addEventListener('submit', function(event) {
        const formData = new FormData(event.target);

        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        return data;
    })
</script>

@endsection