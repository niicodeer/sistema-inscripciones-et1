{{-- @extends('layouts.forms-layout') --}}
@section('title', 'Formulario Inscripción')

<div class="px-2">
    <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Inscripción Ciclo Lectivo {{ date('Y') + 1 }}
    </h1>
    <!-- Cambia dinámicamente el título del paso según el currentStep -->
    <h3 class="text-center text-xl my-4" id="step-title">Datos Alumno</h3>

    <!-- Progreso visual del formulario -->
    <div class="flex gap-0.5 w-[80%] mx-auto mt-4 mb-10">
        <span class="w-full h-1 bg-gray-500" id="progress-bar-1"></span>
        <span class="w-full h-1 bg-gray-500" id="progress-bar-2"></span>
        <span class="w-full h-1 bg-gray-500" id="progress-bar-3"></span>
        <span class="w-full h-1 bg-gray-500" id="progress-bar-4"></span>
        <span class="w-full h-1 bg-gray-500" id="progress-bar-5"></span>
    </div>
    <div id="step1-text">
        <p class="text-base text-[#202020] font-semibold">Comprueba los datos de tu pre-inscripción.<br />
            Si están correctos continúa a la siguiente sección o edita/completa algún campo si hace falta.</p>
    </div>



    <form method="POST" class="flex flex-col gap-y-14 mt-6 items-center" action="" id="multiStepForm">
        @csrf
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-1">
            <x-input type="text" id="cuil" label="Cuil" name="cuil" wire:model="cuil" disabled />
            <x-input type="text" id="nombre" label="Nombre" placeholder="Nombre" wire:model="nombre" require
                value="{{ old('nombre') }}" />
            <x-input type="text" id="apellido" label="Apellido" placeholder="Apellido" wire:model="apellido" require
                value="{{ old('apellido') }}" />
            <x-select id="genero" label="Genero" :options="json_encode(['Femenino', 'Masculino', 'Otro'])" wire:model="genero" require
                value="{{ old('genero') }}" />
            <x-input type="date" id="fecha_nac" label="Fecha Nacimiento" wire:model="fecha_nac" require
                value="{{ old('fecha_nac') }}" />
            <x-input type="email" id="email" label="Email" placeholder="Introduce un correo" wire:model="email"
                require value="{{ old('email') }}" />
            <x-input type="text" id="telefono" label="Teléfono" placeholder="Introduce un telefono"
                wire:model="telefono" require value="{{ old('telefono') }}" />
        </div>
        {{-- @if ($currentStep === 2) --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-2" style="display: none;">
            <x-input type="text" id="calle" label="Calle" placeholder="Calle" wire:model="calle" require
                value="{{ old('calle') }}" />
            <div class="w-[45%] flex gap-x-2">
                <x-input type="number" id="numeracion" label="Numeración" placeholder="Numeración"
                    wire:model="numeracion" min=0 value="{{ old('numeracion') }}" />
                <x-input type="text" id="piso" label="Piso dpto" placeholder="Piso" wire:model="piso"
                    value="{{ old('piso') }}" />
            </div>
            <x-input type="text" id="barrio" label="Barrio" placeholder="Barrio" wire:model="barrio" require
                value="{{ old('barrio') }}" />
            <x-input type="text" id="provincia" label="Provincia" placeholder="Provincia" wire:model="provincia"
                require value="{{ old('provincia') }}" />
            <x-input type="text" id="ciudad" label="Ciudad" placeholder="Ciudad" wire:model="ciudad" require
                value="{{ old('ciudad') }}" />
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Convive con</p>
                <div class="w-full grid grid-cols-2 gap-2">
                    <x-input-check id="madre" label="Madre" value="madre" wire:model="convive" />
                    <x-input-check id="padre" label="Padre" value="padre" wire:model="convive" />
                    <x-input-check id="hermanos" label="Hermano/a" value="hermanos" wire:model="convive" />
                    <x-input-check id="tios" label="Tia/o" value="tios" wire:model="convive" />
                    <x-input-check id="abuelos" label="Abuela/o" value="abuelos" wire:model="convive" />
                    <x-input-check id="otros" label="Otros" value="otros" wire:model="convive" />
                </div>
                @error('convive')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Medio de transporte</p>
                <div class="w-full grid grid-cols-2 gap-2">
                    <x-input-check id="publico" label="Trasporte público" value="transporte_publico"
                        wire:model="transporte" />
                    <x-input-check id="auto" label="Auto / Camioneta" value="auto_camioneta"
                        wire:model="transporte" />
                    <x-input-check id="moto" label="Moto" value="moto" wire:model="transporte" />
                    <x-input-check id="bicicleta" label="Bicicleta" value="bicicleta" wire:model="transporte" />
                    <x-input-check id="otros" label="Otros" value="otros" wire:model="transporte" />
                    <x-input-check id="no-utiliza" label="No utiliza" value="no_utiliza" wire:model="transporte" />
                </div>
                @error('transporte')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class=" w-[45%] flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Obra Social / Prepaga</p>
                <div class="flex md:max-w-[45%] w-full gap-6">
                    <x-input-radio id="obra-social" label="Si" value="1" wire:model.live="obraSocial"
                        wire:click="updateObraSocial" />
                    <x-input-radio id="obra-social" label="No" value="0" wire:model.live="obraSocial"
                        wire:click="updateObraSocial" />
                </div>
                <x-input type="text" id="nombre_os" label="" placeholder="Obra Social / Prepaga"
                    wire:model.live="nombreObraSocial" :disabled="$obraSocial != '1'" />
                @error('obraSocial')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>
        {{-- @endif --}}
        {{-- @if ($currentStep === 3) --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-3" style="display: none;">
            <x-input type="text" id="nombre_tutor" label="Nombre" placeholder="Nombre" wire:model="nombreTutor"
                require value="{{ old('nombre_tutor') }}" />
            <x-input type="text" id="apellido_tutor" label="Apellido" placeholder="Apellido"
                wire:model="apellidoTutor" require value="{{ old('apellido_tutor') }}" />
            <x-input type="text" id="cuil_tutor" label="CUIL" placeholder="Cuil sin guiones ni puntos"
                wire:model="cuilTutor" require value="{{ old('cuil_tutor') }}" />
            <x-input type="email" id="email_tutor" label="Email" placeholder="Introduce un correo"
                wire:model="emailTutor" require value="{{ old('email_tutor') }}" />
            <x-input type="text" id="telefono_tutor" label="Teléfono" placeholder="Introduce un telefono"
                wire:model="telefonoTutor" require value="{{ old('telefono_tutor') }}" />
            <x-input type="text" id="ocupacion" label="Ocupación" placeholder="Ocupación" wire:model="ocupacion"
                require value="{{ old('ocupacion') }}" />
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Parentezco</p>
                <div class="grid grid-cols-2">
                    <x-input-radio id="madre" name="parentezco" label="Madre" value="madre"
                        wire:model="parentezco" />
                    <x-input-radio id="padre" name="parentezco" label="Padre" value="padre"
                        wire:model="parentezco" />
                    <x-input-radio id="hermanos" name="parentezco" label="Hermano/a" value="hermanos"
                        wire:model="parentezco" />
                    <x-input-radio id="tios" name="parentezco" label="Tia/o" value="tios"
                        wire:model="parentezco" />
                    <x-input-radio id="abuelos" name="parentezco" label="Abuela/o" value="abuelos"
                        wire:model="parentezco" />
                    <x-input-radio id="otro" name="parentezco" label="Otro" value="otro"
                        wire:model="parentezco" />
                </div>
                @error('parentezco')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>
        {{-- @endif --}}
        {{-- @if ($currentStep === 4) --}}
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
            id="step-4" style="display: none;">
            <x-select id="curso" label="Seleccione curso" :options="json_encode([
                'Primer año',
                'Segundo año',
                'Tercer año',
                'Cuarto año',
                'Quinto año',
                'Sexto año',
            ])" wire:model.live="curso"
                wire.mode.blur="updatedCurso" require value="{{ old('curso') }}" />
            <x-select id="modalidad" label="Modalidad a seguir" :options="json_encode(['Informática', 'Economía', 'Industria'])" wire:model.live="modalidad"
                :disabled="in_array($curso, ['Primer año', 'Segundo año', ''])" require value="{{ old('modalidad') }}" />

            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Condición Alumno</p>
                <div class="flex md:max-w-[45%] w-full gap-x-8">
                    <div class="flex flex-col gap-3">
                        <x-input-radio id="ingresante" label="Ingresante" value="ingresante" name="condicion_alumno"
                            wire:model.live="condicionAlumno" wire:click="updateEscuela" />
                        <x-input-radio id="regular" label="Regular" value="regular" name="condicion_alumno"
                            wire:model.live="condicionAlumno" wire:click="updateEscuela" />
                    </div>
                    <div class="flex flex-col gap-3">
                        <x-input-radio id="traspaso" label="Traspaso" value="traspaso" name="condicion_alumno"
                            wire:model.live="condicionAlumno" wire:click="updateEscuela" />
                        <x-input-radio id="repitente" label="Repitente" value="repitente" name="condicion_alumno"
                            wire:model.live="condicionAlumno" wire:click="updateEscuela" />
                    </div>
                </div>
                @error('condicionAlumno')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Turno</p>
                <div class="flex flex-col md:max-w-[45%] w-full gap-4">
                    <x-input-radio id="mañana" label="Mañana" value="mañana" name="turno"
                        wire:model="turno" />
                    <x-input-radio id="tarde" label="Tarde" value="tarde" name="turno"
                        wire:model="turno" />
                </div>
                @error('turno')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <x-input type="text" id="escuela_proviene" label="Escuela que proviene" placeholder="Nombre Escuela"
                wire:model.live="escuelaProviene" :disabled="in_array($condicionAlumno, ['regular', ''])" />
            <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                <div class="flex md:max-w-[45%] w-full gap-6">
                    <x-input-radio id="si" label="Si" value="1" name="adeuda_materia"
                        wire:model.live="adeudaMaterias" wire:click="updateAdeudaMaterias" />
                    <x-input-radio id="no" label="No" value="0" name="adeuda_materia"
                        wire:model.live="adeudaMaterias" wire:click="updateAdeudaMaterias" />
                </div>
                @error('adeudaMaterias')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
                <div class="w-[220%]">
                    <x-input type="text" id="adeuda-materia-nombre" label="" placeholder="Nombres materias"
                        wire:model.live="nombreMaterias" :disabled="$adeudaMaterias != '1'" />
                </div>
            </div>
        </div>
        {{-- @endif --}}
        {{-- @if ($currentStep === 5) --}}
        <div id="step-5" style="display: none;" class="step flex-col">
            <p class="text-[#2D3648] font-semibold text-base mb-4">Indique si cumple o no con algunas de las
                siguientes opciones:</p>
            <div class="w-full flex flex-col gap-y-2">
                <x-input-check id="familiar" label="Tengo un familiar que es alumno escuela" value="familiar"
                    wire:model="reconocimientos" />
                <x-input-check id="merito" label="Reconocimiento al mérito" value="merito"
                    wire:model="reconocimientos" />
                <x-input-check id="otros" label="Otros reconocimientos (concursos, mejor compañero,  etc)"
                    value="otros" wire:model="reconocimientos" />
                <x-input-check id="ninguno" label="Ninguno" value="ninguno" wire:model="reconocimientos" />
            </div>
            @error('reconocimientos')
                <p class="text-red-700 text-sm">{{ $message }}</p>
            @enderror
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
                    type="checkbox" wire:model="derechoImagen">
                <p>
                    Acepto el uso de producciones, imágenes, videos y sonido del alumno
                </p>
                @error('terminos')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full flex gap-2 justify-start items-center mt-2">
                <input class="border border-gray-300 p-2 rounded h-5 w-5" id="terminos" name="terminos"
                    type="checkbox" wire:model="terminos">
                <p>
                    He leído y estoy de acuerdo con el <a class='underline' href="{{ route('convivencia.pdf') }}"
                        target="_blank">código de convivencia de la institución</a>

                </p>
                @error('terminos')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>

        </div>
        {{-- @endif --}}
        <div class="flex gap-4 w-full justify-center">
            <x-secondary-button text="Volver" href="{{ route('verificar-cuil') }}" id="toVerifyBtn" />
            <x-secondary-button text="Volver" onclick="prevStep()" id="prevBtn" />
            <x-primary-button text="Siguiente" onclick="nextStep()" type="button" id="nextBtn" />
            {{-- @if ($currentStep === $total_steps)
                <x-primary-button text="Finalizar" />
            @endif --}}

        </div>

    </form>

</div>
<script>
    let currentStep = 1;

    function showStep(step) {
        if (step === 1) {
            document.getElementById('step1-text').style.display = 'block';
        } else {
            document.getElementById('step1-text').style.display = 'none';
        }
        // Oculta todos los pasos
        document.querySelectorAll('.step').forEach((element) => {
            element.style.display = 'none';
        });

        // Muestra el paso actual
        document.getElementById('step-' + step).style.display = 'flex';

        // Actualiza el título del paso
        const titles = ["Datos Alumno", "Datos Alumno", "Datos Tutor", "Selección de curso", "Documentos"];
        document.getElementById('step-title').innerText = titles[step - 1];

        // Actualiza la barra de progreso
        for (let i = 1; i <= 5; i++) {
            document.getElementById('progress-bar-' + i).style.backgroundColor = i <= step ? '#EA9010' : 'gray';
        }

        // Control de visibilidad de botones
        document.getElementById('nextBtn').innerText = step === 5 ? 'Enviar' : 'Siguiente';
        document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
        document.getElementById('toVerifyBtn').style.display = step !== 1 ? 'none' : 'block';
    }

    function nextStep() {
        if (currentStep < 5) {
            currentStep++;
            showStep(currentStep);
        } else {
            // Enviar el formulario
            document.getElementById('multiStepForm').submit();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    // Mostrar el primer paso al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        showStep(currentStep);
    });
</script>
