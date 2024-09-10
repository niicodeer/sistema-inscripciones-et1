@section('title', 'Formulario Preinscripción')
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
        </div>
        <p class="text-grey-400 text-left w-full italic">(<span class="text-red-700">*</span>) Campos obligatorios.</p>
        <x-primary-button text="Finalizar" />
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            // Limpiar mensajes previos de error
            clearErrors();

            // Obtener los valores de los inputs
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const cuil = document.getElementById('cuil').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const genero = document.getElementById('genero').value;
            const fechaNac = document.getElementById('fecha_nac').value;

            let isValid = true;

            // Validar nombre (required, min 3, max 20)
            if (!nombre || nombre.length < 3 || nombre.length > 20) {
                showError('nombre', 'El nombre debe tener entre 3 y 20 caracteres');
                isValid = false;
            }

            // Validar apellido (required, min 3, max 20)
            if (!apellido || apellido.length < 3 || apellido.length > 20) {
                showError('apellido', 'El apellido debe tener entre 3 y 20 caracteres');
                isValid = false;
            }

            // Validar CUIL (required, min 11, max 11, regex)
            const cuilRegex = /^[0-9]{11}$/;
            if (!cuil || !cuilRegex.test(cuil)) {
                showError('cuil', 'El CUIL debe contener 11 números válidos');
                isValid = false;
            }

            // Validar género (required, in [Femenino, Masculino, Otro])
            if (!genero || !['Femenino', 'Masculino', 'Otro'].includes(genero)) {
                showError('genero', 'Debe seleccionar un género válido');
                isValid = false;
            }

            // Validar fecha de nacimiento (required, date, entre 12 y 17 años)
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

            // Validar email (nullable, valid email, min 10, max 100)
            if (email && (email.length < 10 || email.length > 100 || !validateEmail(email))) {
                showError('email',
                    'El email debe ser una dirección válida con entre 10 y 100 caracteres');
                isValid = false;
            }

            // Validar teléfono (required, min 8, max 15, regex)
            const telefonoRegex = /^[0-9\s\-]+$/;
            if (!telefono || telefono.length < 8 || telefono.length > 15 || !telefonoRegex.test(
                    telefono)) {
                showError('telefono', 'El teléfono debe ser un número válido entre 8 y 15 caracteres');
                isValid = false;
            }

            // Si alguna validación falla, evitar el envío del formulario
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Funciones auxiliares para validar email, fecha y mostrar errores
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
