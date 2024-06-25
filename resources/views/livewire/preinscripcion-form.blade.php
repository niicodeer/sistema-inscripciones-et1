@section('title', 'Formulario Preinscripción')
<div class="px-2">
    <div>
        <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Pre-Inscripción Ciclo Lectivo {{ date('Y') + 1 }}</h1>
        <p class="text-base text-[#202020] font-semibold">Completa los siguientes datos del alumno para registrar su
            pre-inscripción</p>
    </div>
    <form class="flex flex-col gap-y-14 mt-6 items-center" action="{{ route('preinscripcion') }}" method="POST">
        @csrf
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
            <x-input type="text" placeholder="Nombre" id="nombre" label="Nombre" />
            <x-input type="text" id="apellido" label="Apellido" placeholder="Apellido" />
            <x-input type="text" id="cuil" label="Cuil"
                placeholder="Introduce el cuil sin guiones ni puntos" />
            <x-select id="genero" label="Género" :options="json_encode(['Femenino', 'Masculino', 'Otro'])" />
            <x-input type="date" id="fecha_nac" label="Fecha Nacimiento" />
            <x-input type="email" id="email" label="Email" placeholder="Introduce un correo" />
            <x-input type="text" id="telefono" label="Teléfono" placeholder="Introduce un telefono" />
        </div>
        <x-primary-button text="Finalizar" />
    </form>
</div>
