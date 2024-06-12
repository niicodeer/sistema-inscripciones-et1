{{-- @extends('layouts.forms-layout') --}}
@section('title', 'Formulario Inscripción')

<div class="px-2">
    <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Inscripción Ciclo Lectivo {{ date('Y') + 1 }}</h1>
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
    <form method="POST" class="flex flex-col gap-y-14 mt-6 items-center" wire:submit="submit">
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
                    <x-input type="text" id="cuil" label="Cuil" name="cuil" wire:model="cuil" disabled />
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
                            <x-input-check id="publico" label="Trasporte público" value="transporte_publico"
                                wire:model="transporte" />
                            <x-input-check id="auto" label="Auto / Camioneta" value="auto_camioneta"
                                wire:model="transporte" />
                            <x-input-check id="moto" label="Moto" value="moto" wire:model="transporte" />
                            <x-input-check id="bicicleta" label="Bicicleta" value="bicicleta"
                                wire:model="transporte" />
                            <x-input-check id="otros" label="Otros" value="otros" wire:model="transporte" />
                            <x-input-check id="no-utiliza" label="No utiliza" value="no_utiliza"
                                wire:model="transporte" />
                        </div>
                        @error('transporte')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" w-[45%] flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Obra Social / Prepaga</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="obra_social" label="Si" value="si"
                                wire:model.live="obraSocial" />
                            <x-input-radio id="obra_social" label="No" value="no"
                                wire:model.live="obraSocial" />
                        </div>
                        <x-input type="text" id="nombre_os" label="" placeholder="Obra Social / Prepaga"
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
                    <x-input type="text" id="nombre_tutor" label="Nombre" placeholder="Nombre"
                        wire:model="nombreTutor" />
                    <x-input type="text" id="apellido_tutor" label="Apellido" placeholder="Apellido"
                        wire:model="apellidoTutor" />
                    <x-input type="text" id="cuil_tutor" label="CUIL" placeholder="Cuil sin guiones ni puntos"
                        wire:model="cuilTutor" />
                    <x-input type="email" id="email_tutor" label="Email" placeholder="Introduce un correo"
                        wire:model="emailTutor" />
                    <x-input type="text" id="telefono_tutor" label="Teléfono" placeholder="Introduce un telefono"
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
                                    name="condicion_alumno" wire:model.live="condicionAlumno" />
                                <x-input-radio id="regular" label="Regular" value="regular"
                                    name="condicion_alumno" wire:model.live="condicionAlumno" />
                            </div>
                            <div class="flex flex-col gap-3">
                                <x-input-radio id="traspaso" label="Traspaso" value="traspaso"
                                    name="condicion_alumno" wire:model.live="condicionAlumno" />
                                <x-input-radio id="repitente" label="Repitente" value="repitente"
                                    name="condicion_alumno" wire:model.live="condicionAlumno" />
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
                    <x-input type="text" id="escuela_proviene" label="Escuela que proviene"
                        placeholder="Nombre Escuela" wire:model="escuelaProviene" :disabled="in_array($condicionAlumno, ['regular', ''])" />
                    <div class="md:max-w-[45%] w-full flex flex-col gap-y-2">
                        <p class="text-[#2D3648] font-semibold text-sm">Adeuda Materias</p>
                        <div class="flex md:max-w-[45%] w-full gap-6">
                            <x-input-radio id="si" label="Si" value="si" name="adeuda-materia"
                                wire:model.live="adeuda_materias" />
                            <x-input-radio id="no" label="No" value="no" name="adeuda-materia"
                                wire:model.live="adeuda_materias" />
                        </div>
                        @error('adeudaMaterias')
                            <p class="text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                        <div class="w-[220%]">
                            <x-input type="text" id="adeuda-materia-nombre" label=""
                                placeholder="Nombres materias" wire:model="nombre_materias" :disabled="$adeudaMaterias != 'si'" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($currentStep === 5)
            <div  x-data="{ open: false }">
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
                    <p>
                        He leído y acepto los términos del <span id="openModalBtn"
                            class="italic underline hover:cursor-pointer" @click="open = ! open">código de
                            vestimenta.</span>
                    </p>
                    @error('terminos')
                        <p class="text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                    {{-- MODAL --}}
                    @teleport('body')
                        <div class="fixed top-0 left-0 h-full w-full bg-black/50 flex  items-center justify-center" x-show="open">
                            <div
                                class="bg-white max-w-[90%] xl:max-w-screen-lg w-fit h-[85%] rounded-3xl p-5 py-14 md:p-16 relative overflow-hidden">
                                <span class="close top-6 right-6" @click="open = ! open">&times;</span>
                                <div
                                    class="flex flex-col gap-8 justify-start items-center w-full max-w-3xl h-full overflow-y-auto py-4">
                                    <h1 class="text-2xl md:text-3xl font-bold text-center">Código de vestimenta <br /> y convivencia</h1>
                                    <p class="">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam
                                        eveniet, quasi accusamus repudiandae optio reiciendis. Corrupti, ipsam tempora ratione nihil
                                        laborum nobis error voluptatibus modi perferendis vitae molestiae voluptas qui!
                                        Ex beatae quam, impedit reprehenderit quas, cupiditate doloribus possimus laudantium
                                        minus ab culpa
                                        voluptate aliquid eius! Voluptatibus fuga, ipsum nemo ullam laudantium ratione
                                        autem. Culpa unde
                                        obcaecati ad natus molestiae?
                                        Nam, voluptate quos commodi nobis beatae necessitatibus explicabo mollitia rem
                                        libero! Illum
                                        perspiciatis molestiae tempora id. Itaque a numquam earum iusto asperiores maiores
                                        eaque sint. Natus
                                        nulla quasi et accusantium.
                                        Perspiciatis hic unde eius aspernatur laborum eum nobis quos illum a fugiat, fuga
                                        placeat facere
                                        incidunt nam fugit iste possimus id temporibus, excepturi mollitia nulla. Culpa
                                        laborum dicta
                                        facilis velit.
                                        Eveniet laboriosam facilis excepturi distinctio deserunt blanditiis qui, hic
                                        delectus cumque
                                        nesciunt consequuntur provident eius, doloribus a repellat incidunt optio nam
                                        inventore explicabo
                                        quae tenetur neque labore! Quis, eveniet blanditiis?
                                        Ratione, fugiat sed quae in assumenda sunt voluptatum qui incidunt ullam nihil
                                        accusamus ipsa maxime
                                        culpa odit quaerat iure veritatis praesentium aspernatur aut esse facere quos
                                        magnam. Laudantium,
                                        voluptatibus excepturi.
                                        Magnam accusantium quod at laboriosam similique expedita dolore. Accusantium vitae
                                        iusto libero fuga
                                        deserunt, sint natus ipsam commodi tempore earum porro vel alias molestias nostrum
                                        et consectetur
                                        incidunt. Maxime, saepe!
                                        Autem, perferendis! Amet nostrum repellat sed, dolore ex accusantium repudiandae
                                        veritatis nemo
                                        eaque quae ad perspiciatis voluptates eligendi dolores sapiente officiis delectus
                                        cumque quam culpa,
                                        vero hic. Blanditiis, harum quis!
                                        Animi ratione molestiae veritatis ex sunt, vitae quod, aliquid aperiam explicabo
                                        temporibus tempore
                                        inventore nostrum laboriosam in autem et a commodi harum nobis atque tempora
                                        placeat. Voluptatem
                                        vitae deleniti nostrum.
                                        Tenetur, porro voluptate! Voluptates enim laudantium, non odit tenetur nostrum eos.
                                        Magnam non totam
                                        a at aut repudiandae iusto sit commodi. Dolore quod ex ipsam eos totam voluptates
                                        blanditiis. Nemo?
                                        Praesentium iusto quae totam? Suscipit commodi quae velit, consequuntur quisquam
                                        provident
                                        veritatis, officia aut, sed alias impedit nemo! Nihil consequuntur corrupti
                                        reiciendis fugiat
                                        ratione repellendus libero accusamus doloremque suscipit sint?
                                        Nisi impedit eius eligendi voluptate illum in praesentium delectus unde facilis ea
                                        dolor earum,
                                        incidunt, sint, quas vero necessitatibus iste aut cumque suscipit animi similique
                                        officiis magni
                                        alias? Minus, magni.
                                        Voluptatem animi maiores totam fugiat, doloribus rerum assumenda qui accusantium
                                        odit, voluptatum
                                        officiis! Assumenda, a nisi dolorem illum facilis fugiat libero! Assumenda nobis
                                        cumque similique
                                        ducimus, fuga fugiat nulla. Repellat.
                                        Tempora ratione dolor debitis, provident temporibus tenetur corrupti modi
                                        perspiciatis numquam harum
                                        maiores exercitationem quisquam minus. Saepe itaque quam recusandae aspernatur ut,
                                        fugiat aut,
                                        debitis nam eos quae consequatur sint!
                                        Cumque sequi pariatur quae a eligendi numquam illo placeat nam optio nobis?
                                        Necessitatibus, sed.
                                        Quaerat et facilis dolores repellat, eius atque, temporibus ipsa iure consequatur
                                        architecto,
                                        dolorum quia quam nihil.
                                        Enim numquam, alias sed odit aperiam laudantium eveniet totam laboriosam consequatur
                                        veniam tenetur
                                        quo debitis quaerat facilis unde reprehenderit. Libero id labore quo earum
                                        cupiditate reprehenderit
                                        veniam assumenda facilis rem?
                                        Exercitationem porro dolorum cumque dicta explicabo fugit, repellendus placeat,
                                        sequi laboriosam vel
                                        maiores rerum! Reiciendis libero, pariatur velit esse asperiores corporis numquam in
                                        ipsam unde
                                        quibusdam nam, officiis perspiciatis cupiditate!
                                        Dolores aliquid eveniet libero hic tempora maxime neque! Iure maxime reiciendis
                                        labore nulla
                                        blanditiis perspiciatis provident, quod nihil libero autem ex corporis soluta
                                        repellendus recusandae
                                        velit alias unde enim facere.
                                        Dicta reprehenderit et, sint tempore nulla eligendi, vero asperiores alias quis at
                                        neque eveniet,
                                        eius reiciendis. Et officia, assumenda consectetur labore temporibus inventore id
                                        aliquid. Eos non
                                        aliquid nihil eveniet!
                                        Esse doloremque molestias assumenda repellendus sint aliquid unde itaque modi quae
                                        doloribus,
                                        expedita provident, voluptatum quaerat autem accusamus accusantium a aperiam quas
                                        vitae reiciendis
                                        repellat ipsam numquam iste? Quidem, ad.
                                        Et, autem animi doloremque, reprehenderit fugiat rerum aliquam officiis mollitia
                                        obcaecati, dolores
                                        veritatis. Suscipit minima labore, provident tenetur vero odio quae. Pariatur,
                                        debitis veritatis? Ab
                                        pariatur dolor assumenda velit doloremque.
                                        Nam doloremque, ut doloribus, officia fugit ex tempore deserunt consequatur corrupti
                                        natus quo
                                        architecto sint delectus! Sapiente nam exercitationem sed accusamus quae cumque
                                        dolorem, voluptate
                                        in similique atque quod amet.
                                        Incidunt commodi voluptatem sed perferendis, molestias atque corporis suscipit.
                                        Voluptatibus ad
                                        officiis accusamus obcaecati assumenda nostrum nesciunt debitis eos, error
                                        asperiores corrupti quas,
                                        tempore quidem quae. Architecto, sed laborum! Iste.
                                        Aliquid pariatur nesciunt atque debitis! Doloribus consectetur quidem explicabo.
                                        Enim, natus magnam
                                        expedita omnis reprehenderit aperiam labore libero doloremque ab voluptas optio
                                        laborum nobis
                                        molestiae? Quia cum expedita ut eius!
                                        Consectetur non id expedita quas quam voluptatum ipsam. Maxime, architecto rem
                                        distinctio deleniti
                                        porro magni cumque facere dicta, sunt dolor omnis optio tenetur, laudantium id alias
                                        corporis
                                        consectetur. Inventore, esse!
                                        Laborum magnam optio blanditiis nihil illum eveniet nam iste sint qui, voluptates
                                        aut atque tempora
                                        exercitationem temporibus magni repudiandae! Tenetur ipsa doloremque quisquam,
                                        minima qui corrupti
                                        quos nulla sequi? Nesciunt?
                                        Unde sunt, soluta quis culpa tempora obcaecati eveniet molestias doloribus nulla
                                        eius consequatur
                                        temporibus asperiores porro amet quaerat rem quas perspiciatis tempore minima quam?
                                        Dolor
                                        perferendis commodi dicta blanditiis ea?
                                        Qui sapiente architecto veritatis vitae omnis quo, sed, ipsa soluta debitis possimus
                                        commodi
                                        accusamus a accusantium dicta necessitatibus, quam incidunt? Mollitia, sequi!
                                        Facilis explicabo
                                        eveniet libero reiciendis qui! Nam, cum.
                                        Exercitationem quod reprehenderit nesciunt, maiores quae earum cum hic eaque
                                        dolorem? Excepturi
                                        repellat, blanditiis, unde corrupti qui cupiditate nobis in minus nihil esse
                                        pariatur deserunt
                                        earum, delectus illum quasi soluta.
                                        Incidunt cupiditate illo nemo fugiat odio reprehenderit adipisci quod consequatur
                                        nulla. Molestias
                                        id sint magni placeat, unde iste atque doloribus voluptates? Animi rerum autem sunt
                                        repudiandae,
                                        impedit nobis accusantium aliquam.
                                        Quam necessitatibus tempore dignissimos nulla deserunt aspernatur et quod atque odio
                                        iure voluptate
                                        voluptatem, quidem omnis consequatur autem provident eligendi repudiandae.
                                        Distinctio molestias
                                        minus ipsum dicta maiores at optio debitis!
                                        Eaque porro dicta, eum mollitia cupiditate numquam tempora consequuntur voluptatibus
                                        corrupti ab non
                                        saepe, dolorum quia nesciunt maiores. Quas tempora porro obcaecati quaerat corporis
                                        pariatur ipsum,
                                        illo autem aliquid a.
                                        Perspiciatis, cumque nisi? Tempore vero dolorum fugit commodi voluptates aperiam
                                        libero, officiis
                                        consectetur suscipit modi eveniet, laborum placeat. Dolorem voluptas maiores quaerat
                                        laboriosam quam
                                        sapiente nostrum consectetur minima error aliquam.
                                        Eligendi nam voluptatibus, dolor dolorem tempore voluptates officia quod magni rem
                                        beatae assumenda
                                        facere corrupti velit voluptatum eius illo aperiam eos quo laudantium est doloribus,
                                        facilis ab
                                        numquam eum! Quidem.
                                        Omnis doloremque eum provident! Aliquam, ullam dolore? Facere rem laborum dolores
                                        deleniti nostrum
                                        nisi sunt vitae asperiores delectus harum suscipit, voluptatibus, quia ipsum in
                                        recusandae at soluta
                                        ut amet odio?
                                        Consectetur dignissimos nesciunt architecto sunt veritatis fugiat facere, illo autem
                                        culpa eveniet
                                        minima illum eius magni maiores amet assumenda praesentium saepe ullam tempora
                                        dolores, ipsum
                                        perspiciatis. Alias, modi. Soluta, sint.
                                        Veritatis aut numquam exercitationem rerum delectus voluptatibus, tempore odio.
                                        Repudiandae at atque
                                        natus eveniet, molestias voluptatibus culpa quibusdam et sequi non exercitationem
                                        omnis saepe maxime
                                        soluta minima consequuntur nisi necessitatibus!
                                        Officia similique quas blanditiis soluta neque itaque reiciendis, cumque fugiat est
                                        minima ullam,
                                        quia provident libero nostrum obcaecati harum. Repudiandae iste, esse quam quasi id
                                        temporibus
                                        maxime ullam animi ducimus!
                                        Assumenda voluptatem ducimus neque dignissimos laborum nobis accusamus sapiente,
                                        maiores iusto sunt
                                        in distinctio ipsum nam ex velit ad mollitia doloribus hic suscipit praesentium quas
                                        eos. Quasi rem
                                        nesciunt iure.
                                        Cumque officia alias numquam beatae ullam assumenda totam veniam quisquam!
                                        Distinctio vel adipisci
                                        iure ut, veniam magni quos consequatur nemo perferendis atque ullam aspernatur
                                        explicabo architecto
                                        animi delectus incidunt minus.</p>

                                </div>
                            </div>

                        </div>
                    @endteleport
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

</div>

