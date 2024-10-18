//Validaciones formulario inscripcion
export function validateStep(step) {
    let isValid = true;
    document.querySelectorAll('.error').forEach(el => el.remove()); // Elimina mensajes de error previos
    document.querySelectorAll('input').forEach(el => el.style.borderColor = '');

    if (step === 1) {
        const nombre = document.querySelector('input[name="nombre_alumno"]');
        if (nombre.value.length < 3 || nombre.value.length > 20) {
            isValid = false;
            showError(nombre, 'El nombre debe tener entre 3 y 20 caracteres.');
        }

        const apellido = document.querySelector('input[name="apellido_alumno"]');
        if (apellido.value.length < 3 || apellido.value.length > 20) {
            isValid = false;
            showError(apellido, 'El apellido debe tener entre 3 y 20 caracteres.');
        }

        const genero = document.querySelector('select[name="genero_alumno"]');
        if (genero.value === '') {
            isValid = false;
            showError(genero, 'Debe seleccionar un género.');
        }

        const fechaNacimientoInput = document.querySelector('input[name="fecha_nac_alumno"]');
        const fechaNacimiento = new Date(fechaNacimientoInput.value);
        const hoy = new Date();
        const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        const mes = hoy.getMonth() - fechaNacimiento.getMonth();
        const dia = hoy.getDate() - fechaNacimiento.getDate();
        const email = document.querySelector('input[name="email_alumno"]');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!fechaNacimientoInput.value) {
            isValid = false;
            showError(fechaNacimientoInput, 'El campo fecha de nacimiento es obligatorio.');
        } else if (edad < 12 || (edad === 12 && (mes < 0 || (mes === 0 && dia < 0)))) {
            isValid = false;
            showError(fechaNacimientoInput, 'Debe tener al menos 12 años.');
        }else if (edad > 22 || (edad === 25 && (mes < 0 || (mes === 0 && dia < 0)))) {
            isValid = false;
            showError(fechaNacimientoInput, 'Debe tener no más de 22 años.');
        }

        if (!emailRegex.test(email.value) || email.value.length < 8 || email.value.length > 100) {
            isValid = false;
            showError(email, 'El email debe ser una dirección válida entre 8 y 100 caracteres.');
        }

        const telefono = document.querySelector('input[name="telefono_alumno"]');
        if (telefono.value.length < 8 || telefono.value.length > 15) {
            isValid = false;
            showError(telefono, 'El teléfono debe tener entre 8 y 15 caracteres.');
        }

    } else if (step === 2) {
        const calle = document.querySelector('input[name="calle"]');
        if (calle.value.length < 5 || calle.value.length > 30) {
            isValid = false;
            showError(calle, 'El campo calle debe tener entre 5 y 30 caracteres.');
        }

        const provincia = document.querySelector('input[name="provincia"]');
        if (!provincia.value) {
            isValid = false;
            showError(provincia, 'El campo provincia es obligatorio.');
        }

        const ciudad = document.querySelector('input[name="ciudad"]');
        if (ciudad.value.length < 5 || ciudad.value.length > 20) {
            isValid = false;
            showError(ciudad, 'El campo ciudad debe tener entre 5 y 20 caracteres.');
        }

        const barrio = document.querySelector('input[name="barrio"]');
        if (barrio.value.length < 5 || barrio.value.length > 20) {
            isValid = false;
            showError(barrio, 'El campo barrio debe tener entre 5 y 20 caracteres.');
        }

        const numeracion = document.querySelector('input[name="numeracion"]');
        if (!numeracion.value || isNaN(numeracion.value)) {
            isValid = false;
            showError(numeracion, 'El campo numeración es obligatorio y debe ser un número.');
        }

        const transporte = document.querySelectorAll('input[name="transporte[]"]:checked');
        if (transporte.length === 0) {
            isValid = false;
            showError(document.getElementById('transporte_error'), 'Debe seleccionar una opción de transporte.');
        }

        const convive = document.querySelectorAll('input[name="convive[]"]:checked');
        if (convive.length === 0) {
            isValid = false;
            showError(document.getElementById('convive_error'), 'Debe seleccionar una opción de convivencia.');
        }

        const obraSocial = document.querySelector('input[name="obra_social"]:checked');
        if (!obraSocial) {
            isValid = false;
            showError(document.getElementById('obraSocial_error'), 'Debe seleccionar si tiene obra social.');
        }

    } else if (step === 3) {
        const nombreTutor = document.querySelector('input[name="nombre_tutor"]');
        if (nombreTutor.value.length < 3 || nombreTutor.value.length > 20) {
            isValid = false;
            showError(nombreTutor, 'El nombre debe tener entre 3 y 20 caracteres.');
        }


        const apellidoTutor = document.querySelector('input[name="apellido_tutor"]');
        if (apellidoTutor.value.length < 3 || apellidoTutor.value.length > 20) {
            isValid = false;
            showError(apellidoTutor, 'El apellido debe tener entre 3 y 20 caracteres.');
        }

        const cuilTutor = document.querySelector('input[name="cuil_tutor"]');
        if (cuilTutor.value.length < 8 || cuilTutor.value.length > 11) {
            isValid = false;
            showError(cuilTutor, 'El CUIL debe tener entre 8 y 11 caracteres.');
        }

        const emailTutor = document.querySelector('input[name="email_tutor"]');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailTutor.value)) {
            isValid = false;
            showError(emailTutor, 'Debe ingresar un correo electrónico válido.');
        }

        const telefonoTutor = document.querySelector('input[name="telefono_tutor"]');
        if (telefonoTutor.value.length < 8 || telefonoTutor.value.length > 15) {
            isValid = false;
            showError(telefonoTutor, 'El teléfono debe tener entre 8 y 15 caracteres.');
        }

        const ocupacionTutor = document.querySelector('input[name="ocupacion_tutor"]');
        if (ocupacionTutor.value.length < 5 || ocupacionTutor.value.length > 30) {
            isValid = false;
            showError(ocupacionTutor, 'La ocupación debe tener entre 5 y 30 caracteres.');
        }

        const parentezco = document.querySelector('input[name="parentezco"]:checked');
        if (!parentezco) {
            isValid = false;
            showError(document.getElementById('parentezco_error'), 'Debe seleccionar una opción de parentezco.');
        }
    } else if (step === 4) {
        const curso = document.querySelector('select[name="curso"]');
        const validCursos = ['Primer año', 'Segundo año', 'Tercer año', 'Cuarto año', 'Quinto año', 'Sexto año'];
        if (!curso.value || !validCursos.includes(curso.value)) {
            isValid = false;
            showError(curso, 'Debe seleccionar un curso válido.');
        }

        const modalidad = document.querySelector('select[name="modalidad"]');
        const validModalidades = ['Informática', 'Economía', 'Industria'];
        if (!modalidad.value || !validModalidades.includes(modalidad.value)) {
            isValid = false;
            showError(modalidad, 'Debe seleccionar una modalidad válida.');
        }

        const condicionAlumno = document.querySelector('input[name="condicion_alumno"]:checked');
        if (!condicionAlumno) {
            isValid = false;
            showError(document.getElementById('condicionAlumno_error'),
                'Debe seleccionar una condición para el alumno.');
        }

        const turno = document.querySelector('input[name="turno"]:checked');
        if (!turno) {
            isValid = false;
            showError(document.getElementById('turno_error'), 'Debe seleccionar un turno.');
        }

        const adeudaMaterias = document.querySelector('input[name="adeuda_materia"]:checked');
        if (!adeudaMaterias) {
            isValid = false;
            showError(document.getElementById('adeudaMaterias_error'), 'Debe seleccionar si adeuda materias.');
        }
    } else if (step === 5) {
        const reconocimientos = document.querySelectorAll('input[name="condicion_inscripcion[]"]:checked');
        if (reconocimientos.length === 0) {
            isValid = false;
            showError(document.getElementById('reconocimientos_error'), 'Debe seleccionar al menos una opción.');
        }

        const terminos = document.getElementById('terminos').checked;

        if (!terminos) {
            isValid = false;
            showError(document.getElementById('terminos_error'),
                'Debe seleccionar que leyó y está de acuerdo con nuestro código.');
        }
    }


    return isValid;
}

export function showError(input, message) {
    const error = document.createElement('span');
    error.classList.add('error');
    error.style.color = 'red';
    error.textContent = message;
    input.insertAdjacentElement('afterend', error);
    input.style.borderColor = 'red';
}


