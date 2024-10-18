document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        clearErrors();
        const nombre = document.getElementById('nombre').value.trim();
        const apellido = document.getElementById('apellido').value.trim();
        const cuil = document.getElementById('cuil').value.trim();
        const email = document.getElementById('email').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const genero = document.getElementById('genero').value;
        const fechaNac = document.getElementById('fecha_nac').value;
        const condicionPreinscripcion = document.querySelectorAll(
            'input[name="condicion_preinscripcion"]');
        const declaracionJurada = document.getElementById('declaracion_jurada').checked;

        let isValid = true;

        if (!nombre || nombre.length < 3 || nombre.length > 20) {
            showError('nombre', 'El nombre debe tener entre 3 y 20 caracteres');
            isValid = false;
        }

        if (!apellido || apellido.length < 3 || apellido.length > 20) {
            showError('apellido', 'El apellido debe tener entre 3 y 20 caracteres');
            isValid = false;
        }

        const cuilRegex = /^[0-9]{11}$/;
        if (!cuil || !cuilRegex.test(cuil)) {
            showError('cuil', 'El CUIL debe contener 11 números válidos');
            isValid = false;
        }

        if (!genero || !['Femenino', 'Masculino', 'Otro'].includes(genero)) {
            showError('genero', 'Debe seleccionar un género válido');
            isValid = false;
        }

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

        if (email && (email.length < 10 || email.length > 100 || !validateEmail(email))) {
            showError('email',
                'El email debe ser una dirección válida con entre 10 y 100 caracteres');
            isValid = false;
        }

        const telefonoRegex = /^[0-9\s\-]+$/;
        if (!telefono || telefono.length < 8 || telefono.length > 15 || !telefonoRegex.test(
                telefono)) {
            showError('telefono', 'El teléfono debe ser un número válido entre 8 y 15 caracteres');
            isValid = false;
        }

        if (!Array.from(condicionPreinscripcion).some(item => item.checked)) {
        showError('condicion_preinscripcion_error', 'Debe seleccionar una condición de preinscripción');
        isValid = false;
    }

        if (!declaracionJurada) {
            showError('declaracion_jurada', 'Debe aceptar la declaración jurada');
            isValid = false;
        }
        if (!isValid) {
            event.preventDefault();
        }
    });

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
