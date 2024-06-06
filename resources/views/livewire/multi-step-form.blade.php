{{-- @extends('layouts.forms-layout') --}}
@section('title', 'Formulario Inscripción')

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
                    <x-input type="text" id="calle" label="Calle" placeholder="Calle" wire:model="calle" />
                    <div class="w-[45%] flex gap-x-2">
                        <x-input type="number" id="numeracion" label="Numeración" placeholder="Numeración"
                            wire:model="numeracion" />
                        <x-input type="text" id="piso" label="Piso dpto" placeholder="Piso" wire:model="piso" />
                    </div>
                    {{-- <x-select id="provincia" label="Provincia" :options="json_encode(['Santiago del Estero', 'Córdoba', 'Otro'])" wire:model="provincia" /> --}}
                    <x-input type="text" id="barrio" label="Barrio" placeholder="Barrio" wire:model="barrio" />
                    <x-input type="text" id="provincia" label="Provincia" placeholder="Provincia"
                        wire:model="provincia" />
                    <x-input type="text" id="ciudad" label="Ciudad" placeholder="Ciudad" wire:model="ciudad" />
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
                            <x-input-check id="publico" label="Trasporte público" value="transporte-publico"
                                wire:model="transporte" />
                            <x-input-check id="auto" label="Auto / Camioneta" value="auto-camioneta"
                                wire:model="transporte" />
                            <x-input-check id="moto" label="Moto" value="moto" wire:model="transporte" />
                            <x-input-check id="bicicleta" label="Bicicleta" value="bicicleta"
                                wire:model="transporte" />
                            <x-input-check id="otros" label="Otros" value="otros" wire:model="transporte" />
                            <x-input-check id="no-utiliza" label="No utiliza" value="no-utiliza"
                                wire:model="transporte" />
                        </div>
                        @error('transporte')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" w-[45%] flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Obra Social / Prepaga</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="obra-social" label="Si" value="si"
                                wire:model.live="obraSocial" />
                            <x-input-radio id="obra-social" label="No" value="no"
                                wire:model.live="obraSocial" />
                        </div>
                        <x-input type="text" id="nombre-os" label="" placeholder="Obra Social / Prepaga"
                            wire:model="nombreObraSocial" :disabled="$obraSocial != 'si'" :value="$obraSocial == 'no' ? '' : $nombreObraSocial" />
                        @error('obraSocial')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
        @if ($currentStep === 3)
            <div>
                <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
                    <x-input type="text" id="nombreTutor" label="Nombre" placeholder="Nombre"
                        wire:model="nombreTutor" />
                    <x-input type="text" id="apellidoTutor" label="Apellido" placeholder="Apellido"
                        wire:model="apellidoTutor" />
                    <x-input type="text" id="cuilTutor" label="CUIL" placeholder="Cuil sin guiones ni puntos"
                        wire:model="cuilTutor" />
                    <x-input type="email" id="emailTutor" label="Email" placeholder="Introduce un correo"
                        wire:model="emailTutor" />
                    <x-input type="text" id="telefonoTutor" label="Teléfono" placeholder="Introduce un telefono"
                        wire:model="telefonoTutor" />
                    <x-input type="text" id="ocupacion" label="Ocupación" placeholder="Ocupación"
                        wire:model="ocupacion" />
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
            </div>
        @endif
        @if ($currentStep === 4)
            <div>
                <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
                    <x-select id="curso" label="Seleccione curso" :options="json_encode([
                        'Primer año',
                        'Segundo año',
                        'Tercer año',
                        'Cuarto año',
                        'Quinto año',
                        'Sexto año',
                    ])" wire:model.live="curso" />
                    <x-select id="modalidad" label="Modalidad a seguir" :options="json_encode(['Informática', 'Economía', 'Industria'])" wire:model="modalidad"
                        :disabled="in_array($curso, ['Primer año', 'Segundo año', ''])" />

                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Condición Alumno</p>
                        <div class="flex md:max-w-[45%] w-full gap-x-8">
                            <div class="flex flex-col gap-3">
                                <x-input-radio id="ingresante" label="Ingresante" value="ingresante"
                                    name="condicion-alumno" wire:model.live="condicionAlumno" />
                                <x-input-radio id="regular" label="Regular" value="regular"
                                    name="condicion-alumno" wire:model.live="condicionAlumno" />
                            </div>
                            <div class="flex flex-col gap-3">
                                <x-input-radio id="traspaso" label="Traspaso" value="traspaso"
                                    name="condicion-alumno" wire:model.live="condicionAlumno" />
                                <x-input-radio id="repitente" label="Repitente" value="repitente"
                                    name="condicion-alumno" wire:model.live="condicionAlumno" />
                            </div>
                        </div>
                        @error('condicionAlumno')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Turno</p>
                        <div class="flex flex-col md:max-w-[45%] w-full gap-4">
                            <x-input-radio id="maniana" label="Mañana" value="maniana" name="turno"
                                wire:model="turno" />
                            <x-input-radio id="tarde" label="Tarde" value="tarde" name="turno"
                                wire:model="turno" />
                        </div>
                        @error('turno')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-input type="text" id="escuelaProviene" label="Escuela que proviene"
                        placeholder="Nombre Escuela" wire:model="escuelaProviene" :disabled="in_array($condicionAlumno, ['regular', ''])" />
                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="si" label="Si" value="si" name="adeuda-materia"
                                wire:model.live="adeudaMaterias" />
                            <x-input-radio id="no" label="No" value="no" name="adeuda-materia"
                                wire:model.live="adeudaMaterias" />
                        </div>
                        @error('adeudaMaterias')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                        <div class="w-[220%]">
                            <x-input type="text" id="adeuda-materia-nombre" label=""
                                placeholder="Nombres materias" wire:model="nombreMaterias" :disabled="$adeudaMaterias != 'si'" />
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
                @error('reconocimientos')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
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
                        He leído y acepto los términos del <span id="openModalBtn"
                            class="italic underline hover:cursor-pointer">código de
                            vestimenta.</span>
                    </label>
                    @error('terminos')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        @endif
        <div class="flex gap-4 w-full justify-center">
            @if ($currentStep == 1)
                <x-secondary-button text="Volver" href="{{ route('verificar-cuil') }}" />
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
    {{-- MODAL --}}
    <div id="myModal" class="modal justify-center items-center">
        <div class="bg-white max-w-[70%] xl:max-w-screen-lg w-fit h-fit rounded-3xl p-5 py-7 md:p-16 relative">
            <span class="close top-6 right-6">&times;</span>
            <div class="flex flex-col gap-8 justify-center items-center w-full max-w-96">
                <h1 class="text-2xl md:text-3xl font-bold">Registramos tu <br /> pre-inscripción!</h1>
                <p class="">Gracias por pre-inscribirte! En los próximos meses te esteremos avisando las fechas
                    de
                    inscripción. ¡Estate
                    atento a tu correo y a nuestro perfil de Facebook!</p>


                <div class="flex gap-2 items-center">
                    <div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_96_3094)">
                                <path
                                    d="M21.8715 0.905273H2.12965C1.45344 0.905273 0.905273 1.45344 0.905273 2.12965V21.8715C0.905273 22.5477 1.45344 23.0959 2.12965 23.0959H21.8715C22.5477 23.0959 23.0959 22.5477 23.0959 21.8715V2.12965C23.0959 1.45344 22.5477 0.905273 21.8715 0.905273Z"
                                    fill="#3D5A98" />
                                <path
                                    d="M16.215 23.0943V14.5012H19.0987L19.53 11.1524H16.215V9.01494C16.215 8.04557 16.485 7.38369 17.8743 7.38369H19.6481V4.38369C18.7892 4.29418 17.926 4.25161 17.0625 4.25619C14.5087 4.25619 12.75 5.81244 12.75 8.68307V11.1524H9.86621V14.5012H12.75V23.0943H16.215Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_96_3094">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <a href="#" class="underline">Escuela Técnica Nº 1</a>
                </div>
                <div class="flex gap-2 flex-col items-center">
                    <x-primary-button text="Descargar comprobante" onclick="mostrarAlerta()" /> {{-- TODO: crear funcion para descargar comprobante pdf --}}
                    <x-secondary-button text="Volver al inicio" href="{{ route('inicio') }}" />
                </div>
            </div>
        </div>

    </div>
</div>
