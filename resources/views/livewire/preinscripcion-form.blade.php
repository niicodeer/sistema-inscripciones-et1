@section('title', 'Formulario Preinscripción')
<div class="px-2">
    <div>
        <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Pre-Inscripción Ciclo Lectivo {{ date('Y') + 1 }}</h1>
        <p class="text-base text-center text-[#202020] font-semibold">Completa los siguientes datos del alumno para registrar su
            pre-inscripción</p>
    </div>
    <form class="flex flex-col gap-y-14 mt-6 items-center" action="{{ route('preinscripcion') }}" method="POST">
        @csrf
        <div class="flex flex-col md:flex-row md:flex-wrap justify-between gap-y-4 md:gap-y-8 w-full">
            <x-input type="text" id="cuil" label="Cuil" require placeholder="Introduce el cuil sin guiones ni puntos" value="{{ old('cuil') }}" />
            <x-input type="text" placeholder="Nombre" id="nombre" label="Nombre" require value="{{ old('nombre') }}" />
            <x-input type="text" id="apellido" label="Apellido" require placeholder="Apellido" value="{{ old('apellido') }}" />
            <x-select id="genero" label="Género" require :options="json_encode(['Femenino', 'Masculino', 'Otro'])" />
            <x-input type="date" id="fecha_nac" require label="Fecha Nacimiento" value="{{ old('fecha_nac') }}" />
            <x-input type="email" id="email" label="Email" require placeholder="Introduce un correo" value="{{ old('email') }}" />
            <x-input type="text" id="telefono" label="Teléfono" require placeholder="Introduce un telefono" value="{{ old('telefono') }}" />
        </div>
        <p class="text-grey-400 text-left w-full italic">(<span class="text-red-700">*</span>) Campos obligatorios.</p>
        <x-primary-button text="Finalizar" />
    </form>
</div>
