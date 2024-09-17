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
            <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar" id="progress-bar-2"></span></span>
            <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar" id="progress-bar-3"></span></span>
            <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar" id="progress-bar-4"></span></span>
            <span class="w-full h-1 bg-gray-500"><span class="w-full h-1 block progress-bar" id="progress-bar-5"></span></span>
            
        </div>
        <div id="step1-text">
            <p class="text-base text-[#202020] font-semibold">Comprueba los datos de tu pre-inscripción.<br />
                Si están correctos continúa a la siguiente sección o edita/completa algún campo si hace falta.</p>
        </div>

        <form method="POST" class="flex flex-col gap-y-14 mt-6 items-center" id="multiStepForm"
            action="{{ route('inscripcion') }}">
            @csrf
            {{-- Step 1 --}}
            <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
                id="step-1">
                <x-input type="text" id="cuil_alumno" label="Cuil" disabled />
                <x-input type="text" id="nombre_alumno" label="Nombre" placeholder="Nombre" require
                    value="{{ old('nombre') }}" />
                <x-input type="text" id="apellido_alumno" label="Apellido" placeholder="Apellido" require
                    value="{{ old('apellido') }}" />
                <x-select id="genero_alumno" label="Genero" :options="json_encode(['Femenino', 'Masculino', 'Otro'])" require value="{{ old('genero') }}" />
                <x-input type="date" id="fecha_nac_alumno" label="Fecha Nacimiento" require
                    value="{{ old('fecha_nac') }}" />
                <x-input type="email" id="email_alumno" label="Email" placeholder="Introduce un correo" require
                    value="{{ old('email') }}" />
                <x-input type="text" id="telefono_alumno" label="Teléfono" placeholder="Introduce un telefono" require
                    value="{{ old('telefono') }}" />
            </div>
            {{-- Step 2 --}}
            <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
                id="step-2" style="display: none;">
                <x-input type="text" id="calle" label="Calle" placeholder="Calle" require
                    value="{{ old('calle') }}" />
                <div class="w-[45%] flex gap-x-2">
                    <x-input type="number" id="numeracion" label="Numeración" placeholder="Numeración" min=0
                        value="{{ old('numeracion') }}" />
                    <x-input type="text" id="piso" label="Piso dpto" placeholder="Piso"
                        value="{{ old('piso') }}" />
                </div>
                <x-input type="text" id="barrio" label="Barrio" placeholder="Barrio" require
                    value="{{ old('barrio') }}" />
                <x-input type="text" id="provincia" label="Provincia" placeholder="Provincia" require
                    value="{{ old('provincia') }}" />
                <x-input type="text" id="ciudad" label="Ciudad" placeholder="Ciudad" require
                    value="{{ old('ciudad') }}" />
                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Convive con</p>
                    <div class="w-full grid grid-cols-2 gap-2">
                        <x-input-check id="convive_madre" label="Madre" value="madre" name="convive[]" />
                        <x-input-check id="convive_padre" label="Padre" value="padre" name="convive[]" />
                        <x-input-check id="convive_hermanos" label="Hermano/a" value="hermanos" name="convive[]" />
                        <x-input-check id="convive_tios" label="Tia/o" value="tios" />
                        <x-input-check id="convive_abuelos" label="Abuela/o" value="abuelos" name="convive[]" />
                        <x-input-check id="convive_otros" label="Otros" value="otros" name="convive[]" />
                    </div>
                    @error('convive')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Medio de transporte</p>
                    <div class="w-full grid grid-cols-2 gap-2">
                        <x-input-check id="transporte-publico" label="Trasporte público" value="transporte publico"
                            name="transporte[]" />
                        <x-input-check id="transporte-auto" label="Auto / Camioneta" value="auto camioneta"
                            name="transporte[]" />
                        <x-input-check id="transporte-moto" label="Moto" value="moto" name="transporte[]" />
                        <x-input-check id="transporte-bicicleta" label="Bicicleta" value="bicicleta"
                            name="transporte[]" />
                        <x-input-check id="transporte-otro" label="Otros" value="otros" name="transporte" />
                        <x-input-check id="transporte-no-utiliza" label="No utiliza" value="no utiliza"
                            name="transporte[]" />
                    </div>
                    @error('transporte')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class=" w-[45%] flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Obra Social / Prepaga</p>
                    <div class="flex md:max-w-[45%] w-full gap-6">
                        <x-input-radio id="obra_social_si" label="Si" value="1" name="obra_social" />
                        <x-input-radio id="obra_social_no" label="No" value="0" name="obra_social" />
                    </div>
                    <x-input type="text" id="nombre_os" label="" placeholder="Obra Social / Prepaga" />
                    @error('obraSocial')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Step 3 --}}
            <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
                id="step-3" style="display: none;">
                <x-input type="text" id="nombre_tutor" label="Nombre" placeholder="Nombre" require
                    value="{{ old('nombre_tutor') }}" />
                <x-input type="text" id="apellido_tutor" label="Apellido" placeholder="Apellido" require
                    value="{{ old('apellido_tutor') }}" />
                <x-input type="text" id="cuil_tutor" label="CUIL" placeholder="Cuil sin guiones ni puntos" require
                    value="{{ old('cuil_tutor') }}" />
                <x-input type="email" id="email_tutor" label="Email" placeholder="Introduce un correo" require
                    value="{{ old('email_tutor') }}" />
                <x-input type="text" id="telefono_tutor" label="Teléfono" placeholder="Introduce un telefono" require
                    value="{{ old('telefono_tutor') }}" />
                <x-input type="text" id="ocupacion_tutor" label="Ocupación" placeholder="Ocupación" require
                    value="{{ old('ocupacion') }}" />
                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Parentezco</p>
                    <div class="grid grid-cols-2">
                        <x-input-radio id="madre" name="parentezco" label="Madre" value="madre" />
                        <x-input-radio id="padre" name="parentezco" label="Padre" value="padre" />
                        <x-input-radio id="hermanos" name="parentezco" label="Hermano/a" value="hermanos" />
                        <x-input-radio id="tios" name="parentezco" label="Tia/o" value="tios" />
                        <x-input-radio id="abuelos" name="parentezco" label="Abuela/o" value="abuelos" />
                        <x-input-radio id="otro" name="parentezco" label="Otro" value="otro" />
                    </div>
                    @error('parentezco')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Step 4 --}}
            <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full step"
                id="step-4" style="display: none;">
                <x-select id="curso" label="Seleccione curso" :options="json_encode([
                    'Primer año',
                    'Segundo año',
                    'Tercer año',
                    'Cuarto año',
                    'Quinto año',
                    'Sexto año',
                ])" require
                    value="{{ old('curso') }}" />
                <x-select id="modalidad" label="Modalidad a seguir" :options="json_encode(['Informática', 'Economía', 'Industria'])" {{-- :disabled="in_array(['Primer año', 'Segundo año', ''])"  --}}require
                    value="{{ old('modalidad') }}" />

                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Condición Alumno</p>
                    <div class="flex md:max-w-[45%] w-full gap-x-8">
                        <div class="flex flex-col gap-3">
                            <x-input-radio id="ingresante" label="Ingresante" value="ingresante"
                                name="condicion_alumno" />
                            <x-input-radio id="regular" label="Regular" value="regular" name="condicion_alumno" />
                        </div>
                        <div class="flex flex-col gap-3">
                            <x-input-radio id="traspaso" label="Traspaso" value="traspaso" name="condicion_alumno" />
                            <x-input-radio id="repitente" label="Repitente" value="repitente" name="condicion_alumno" />
                        </div>
                    </div>
                    @error('condicionAlumno')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Turno</p>
                    <div class="flex flex-col md:max-w-[45%] w-full gap-4">
                        <x-input-radio id="mañana" label="Mañana" value="mañana" name="turno" />
                        <x-input-radio id="tarde" label="Tarde" value="tarde" name="turno" />
                    </div>
                    @error('turno')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <x-input type="text" id="escuela_proviene" label="Escuela que proviene" placeholder="Nombre Escuela"
                    {{-- :disabled="in_array(['regular', ''])" --}} />
                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                    <div class="flex md:max-w-[45%] w-full gap-6">
                        <x-input-radio id="adeuda_si" label="Si" value="1" name="adeuda_materia" />
                        <x-input-radio id="adeuda_no" label="No" value="0" name="adeuda_materia" />
                    </div>
                    @error('adeudaMaterias')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                    <div class="lg:w-[220%]">
                        <x-input type="text" id="adeuda-materia-nombre" label=""
                            placeholder="Nombres materias" />
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
                </div>

            </div>
            <div class="flex gap-4 w-full justify-center">
                <x-secondary-button text="Volver" href="{{ route('verificar-cuil') }}" id="toVerifyBtn" />
                <x-secondary-button text="Volver" onclick="prevStep()" id="prevBtn" class="none"/>
                <x-primary-button text="Siguiente" onclick="nextStep()" type="button" id="nextBtn" />
                <x-primary-button text="Enviar" type="submit" id="submitBtn" class="none"/>
            </div>
        </form>

    </div>
@endsection
@section('scripts')
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

            // Control de visibilidad de botones
            document.getElementById('nextBtn').style.display = step === 5 ? 'none' : 'block';;
            document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
            document.getElementById('toVerifyBtn').style.display = step !== 1 ? 'none' : 'block';
            document.getElementById('submitBtn').style.display = step !== 5 ? 'none' : 'block';
        }

        function nextStep() {
            if (currentStep < 5) {
                currentStep++;
                showStep(currentStep);
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
        document.getElementById('multiStepForm').addEventListener('submit', function(event) {
            //event.preventDefault(); // Prevenir el envío del formulario
            const formData = new FormData(event.target);
            const data = {};

            // Recorrer los valores del formulario y agregarlos al objeto 'data'
            formData.forEach((value, key) => {
                data[key] = value;
            });
            console.log(data);
            return data;
        });
    </script>
@endsection
