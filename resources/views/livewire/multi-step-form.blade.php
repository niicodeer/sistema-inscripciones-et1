{{-- @extends('layouts.forms-layout') --}}
@section('title', 'Formulario Inscripción')

{{-- @section('content') --}}
<div class="px-2">
    <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Inscripción Ciclo Lectivo 2024</h1>
    @if ($currentStep <= 2)
        <h3 class="text-center text-xl my-4">Datos Alumno</h3>
    @endif
    @if ($currentStep === 3)
        <h3 class="text-center text-xl my-4">Datos Tutor</h3>
    @endif
    @if ($currentStep === 4)
        <h3 class="text-center text-xl my-4">Selección de curso</h3>
    @endif
    @if ($currentStep === 5)
        <h3 class="text-center text-xl my-4">Documentos</h3>
    @endif
    <div class="flex gap-0.5 w-[80%] mx-auto mt-4 mb-10">
        <span class="w-full h-1 {{ $currentStep >= 1 ? 'bg-[#EA9010]' : 'bg-gray-500' }}"></span>
        <span class="w-full h-1 {{ $currentStep >= 2 ? 'bg-[#EA9010]' : 'bg-gray-500' }}"></span>
        <span class="w-full h-1 {{ $currentStep >= 3 ? 'bg-[#EA9010]' : 'bg-gray-500' }}"></span>
        <span class="w-full h-1 {{ $currentStep >= 4 ? 'bg-[#EA9010]' : 'bg-gray-500' }}"></span>
        <span class="w-full h-1 {{ $currentStep === 5 ? 'bg-[#EA9010]' : 'bg-gray-500' }}"></span>
    </div>
    <div>
        @if ($currentStep === 1)
            <p class="text-base text-[#202020] font-semibold">Comprueba los datos de tu pre-inscripción.<br />
                Si están correctos continúa a la siguiente sección o edita/completa algún campo si hace falta.</p>
        @endif
    </div>
    <form class="flex flex-col gap-y-14 mt-6 items-center" wire:submit="submit">
        @csrf
        @if ($currentStep === 1)
            <div>
                <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
                    <x-input type="text" id="nombre" label="Nombre" placeholder="Nombre" wire:model="nombre" />
                    <x-input type="text" id="apellido" label="Apellido" placeholder="Apellido"
                        wire:model="apellido" />
                    <x-select id="genero" label="Genero" :options="json_encode(['Femenino', 'Masculino', 'Otro'])" wire:model="genero" />
                    <x-input type="date" id="fecha_nac" label="Fecha Nacimiento" wire:model="fecha_nac" />
                    <x-input type="email" id="email" label="Email" placeholder="Introduce un correo"
                        wire:model="email" />
                    <x-input type="text" id="telefono" label="Teléfono" placeholder="Introduce un telefono"
                        wire:model="telefono" />
                </div>
            </div>
        @endif
        @if ($currentStep === 2)
            <div>
                <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
                    <x-input type="text" id="domicilio" label="Domicilio" placeholder="Domicilio"
                        wire:model="domicilio" />
                    <x-input type="text" id="ciudad" label="Ciudad" placeholder="Ciudad" wire:model="ciudad" />

                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Medio de transporte</p>
                        <x-input-check id="publico" label="Trasporte público" value="transporte-publico"
                            wire:model="transporte" />
                        <x-input-check id="auto" label="Auto / Camioneta" value="auto-camioneta"
                            wire:model="transporte" />
                        <x-input-check id="moto" label="Moto" value="moto" wire:model="transporte" />
                        <x-input-check id="bicicleta" label="Bicicleta" value="bicicleta" wire:model="transporte" />
                        <x-input-check id="otros" label="Otros" value="otros" wire:model="transporte" />
                        <x-input-check id="no-utiliza" label="No utiliza" value="no-utiliza" wire:model="transporte" />
                    </div>

                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Convive con</p>
                        <x-input-check id="madre" label="Madre" value="madre" wire:model="convive" />
                        <x-input-check id="padre" label="Padre" value="padre" wire:model="convive" />
                        <x-input-check id="hermanos" label="Hermano/a" value="hermanos" wire:model="convive" />
                        <x-input-check id="tios" label="Tia/o" value="tios" wire:model="convive" />
                        <x-input-check id="abuelos" label="Abuela/o" value="abuelos" wire:model="convive" />
                    </div>
                    <div class="w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Obra Social / Prepaga</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="obra-social" label="Si" value="si" wire:model="obraSocial" />
                            <x-input-radio id="obra-social" label="No" value="no" wire:model="obraSocial" />
                        </div>
                        <x-input type="text" id="nombre-os" label="" placeholder="Obra Social / Prepaga"
                            wire:model="nombreObraSocial" />
                    </div>
                </div>
            </div>
        @endif
        @if ($currentStep === 3)
            <div>
                <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
                    <x-input type="text" id="nombre-tutor" label="Nombre" placeholder="Nombre"
                        wire:model="nombreTutor" />
                    <x-input type="text" id="apellido-tutor" label="Apellido" placeholder="Apellido"
                        wire:model="apellidoTutor" />
                    <x-input type="text" id="cuil-tutor" label="CUIL" placeholder="Cuil sin guiones ni puntos"
                        wire:model="cuilTutor" />
                    <x-input type="email" id="email-tutor" label="Email" placeholder="Introduce un correo"
                        wire:model="emailTutor" />
                    <x-input type="text" id="telefono-tutor" label="Teléfono" placeholder="Introduce un telefono"
                        wire:model="telefonoTutor" />
                    <x-input type="text" id="ocupacion" label="Ocupación" placeholder="Ocupación"
                        wire:model="ocupacion" />
                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Parentezco</p>
                        <x-input-radio id="madre" name="parentezco" label="Madre" value="madre"
                            wire:model="parentezco" />
                        <x-input-radio id="padre" name="parentezco" label="Padre" value="padre"
                            wire:model="parentezco" />
                        <x-input-radio id="hermanos" name="parentezco" label="Hermano/a" value="hermanos"
                            wire:model="parentezco" />
                        <x-input-radio id="tios" name="parentezco" label="Tia/o" value="tios"
                            wire:model="nombreTuparentezcotor" />
                        <x-input-radio id="abuelos" name="parentezco" label="Abuela/o" value="abuelos"
                            wire:model="parentezco" />
                    </div>
                </div>
            </div>
        @endif
        @if ($currentStep === 4)
            <div>
                <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
                    <x-select id="curso-anio" label="Seleccione curso" :options="json_encode([
                        'Primer año',
                        'Segundo año',
                        'Tercer año',
                        'Cuarto año',
                        'Quinto año',
                        'Sexto año',
                    ])" wire:model="curso" />
                    <x-select id="modalidad" label="Modalidad a seguir" :options="json_encode(['Informatica', 'Economía', 'Industria'])" wire:model="modalidad" />
                    <x-input type="text" id="escuela-proviene" label="Escuela que proviene"
                        placeholder="Nombre Escuela" wire:model="escuelaProviene" />
                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Turno</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="maniana" label="Mañana" value="maniana" name="turno"
                                wire:model="turno" />
                            <x-input-radio id="tarde" label="Tarde" value="tarde" name="turno"
                                wire:model="turno" />
                        </div>
                    </div>
                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Condición Alumno</p>
                        <div class="flex md:max-w-[45%] w-full gap-x-8">
                            <div class="flex flex-col gap-3">
                                <x-input-radio id="ingresante" label="Ingresante" value="ingresante"
                                    name="condicion-alumno" wire:model="condicionAlumno" />
                                <x-input-radio id="regular" label="Regular" value="regular"
                                    name="condicion-alumno" wire:model="condicionAlumno" />
                            </div>
                            <div class="flex flex-col gap-3">
                                <x-input-radio id="traspaso" label="Traspaso" value="traspaso"
                                    name="condicion-alumno" wire:model="condicionAlumno" />
                                <x-input-radio id="repitente" label="Repitente" value="repitente"
                                    name="condicion-alumno" wire:model="condicionAlumno" />
                            </div>
                        </div>
                    </div>
                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="si" label="Si" value="si" name="adeuda-materia"
                                wire:model="adeudaMaterias" />
                            <x-input-radio id="no" label="No" value="no" name="adeuda-materia"
                                wire:model="adeudaMaterias" />
                        </div>
                        <div class="w-[220%]">
                            <x-input type="text" id="adeuda-materia-nombre" label=""
                                placeholder="Nombres materias" wire:model="nombreMaterias" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($currentStep === 5)
            <div>
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
                <div class="my-6">
                    <p class="text-[#2D3648] italic font-bold text-base">* En caso de cumplir con alguna opción debe
                        presentar en la institución una copia del certificado que lo respalde.</p>
                    <p class="text-[#2D3648] italic font-bold text-base">* Además, recuerde que debe proporcionar una
                        foto 4x4 y fotocopia del DNI del inscripto.</p>
                </div>
                <p class="text-[#2D3648] font-semibold text-base pt-6">Por último, indique que leyó nuestro código de
                    vestimenta y está de acuerdo.</p>
                <div class="w-full flex gap-2 justify-start items-center mt-2">
                    <input class="border border-gray-300 p-2 rounded h-5 w-5" id="terminos" name="terminos"
                        type="checkbox" wire:model="terminos">
                    <label for="terminos">
                        He leído y acepto los términos del <a href="" class="italic underline">código de
                            vestimenta.</a>
                    </label>
                </div>

            </div>
        @endif
        <div class="flex gap-4 w-full justify-center">
            @if ($currentStep == 1)
                <x-secondary-button text="Volver" href="{{ route('verificar-cuil') }}"/>
            @endif
            @if ($currentStep > 1)
                <x-secondary-button text="Volver" wire:click="decrementSteps" />
            @endif
            @if ($currentStep < 5)
                <x-primary-button text="Siguiente" wire:click="incrementSteps" type="button" />
            @endif
            @if ($currentStep === $total_steps)
                <x-primary-button text="Finalizar" type="submit" />
            @endif

        </div>

    </form>
</div>
{{-- @endsection --}}
