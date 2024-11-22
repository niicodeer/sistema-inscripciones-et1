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
                <input type="hidden" id="id_alumno" name="id_alumno" value="{{ $data['id'] ?? null }}">
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
                        value="{{ $data['dato']['numeracion'] ?? '' }}" require />
                    <x-input type="text" id="piso" label="Piso dpto" placeholder="Piso"
                        value="{{ $data['dato']['piso'] ?? '' }}" />
                </div>
                <x-input type="text" id="barrio" label="Barrio" placeholder="Barrio" require
                    value="{{ $data['dato']['barrio'] ?? '' }}" />
                <x-select id="departamento" label="Departamento" :options="json_encode([])" require />
                <x-select id="localidad" label="Localidad" :options="json_encode([])" require />
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
                    @error('obra_social')
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
                <x-select id="modalidad" label="Modalidad a seguir" :options="json_encode(['Informática', 'Economía', 'Industria'])" require
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
                    @error('condicion_alumno')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                    <p id="condicionAlumno_error"></p>
                </div>

                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Turno</p>
                    <div class="flex flex-col md:max-w-[45%] w-full gap-4">
                        <x-input-radio id="mañana" label="Mañana" value="Mañana" name="turno"
                            check="{{ ($inscripcion['turno'] ?? '') === 'Mañana' }}" />
                        <x-input-radio id="tarde" label="Tarde" value="Tarde" name="turno"
                            check="{{ ($inscripcion['turno'] ?? '') === 'Tarde' }}" />
                    </div>
                    @error('turno')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                    <p id="turno_error"></p>
                </div>

                <x-input type="text" id="escuela_proviene" label="Escuela que proviene" placeholder="Nombre Escuela"
                    value="{{ $inscripcion['escuela_proviene'] ?? '' }}" class="w-full" />


                <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                    <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                    <div class="flex md:max-w-[45%] w-full gap-6">
                        <x-input-radio id="adeuda_si" label="Si" value="1" name="adeuda_materias"
                            check="{{ ($inscripcion['adeuda_materias'] ?? '') === 1 }}" />
                        <x-input-radio id="adeuda_no" label="No" value="0" name="adeuda_materias"
                            check="{{ ($inscripcion['adeuda_materias'] ?? '') === 0 }}" />
                    </div>
                    @error('adeuda_materias')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                    <p id="adeudaMaterias_error"></p>
                    <div class="lg:w-[220%]">
                        <x-input type="text" id="nombre_materias" label="" placeholder="Nombres materias"
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
                    <input class="border border-gray-300 p-2 rounded h-5 w-5" id="uso_producciones_alumno"
                        name="uso_producciones_alumno" type="checkbox">
                    <p>
                        Acepto el uso de producciones, imágenes, videos y sonido del alumno
                    </p>

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
                <p id="terminos_error"></p>
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
    <script type="module" src="{{ asset('js/inscripcion-form-scripts.js') }}"></script>
@endsection
