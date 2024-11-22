import { validateStep } from './validaciones.js';
import { LOCALIDADES, DEPARTAMENTOS } from './datos-geograficos.js';

let currentStep = 1;
const form = document.getElementById('multiStepForm');
const steps = form.querySelectorAll('.step');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');
const verifyBtn = document.getElementById('toVerifyBtn');
const submitBtn = document.getElementById('submitBtn');
let actualStep;
const modalidad = document.querySelector('select[name="modalidad"]');
modalidad.disabled = true;


function showStep(step) {
    if (step === 1) {
        document.getElementById('step1-text').style.display = 'block';
    } else {
        document.getElementById('step1-text').style.display = 'none';
    }
    steps.forEach((element) => {
        element.style.display = 'none';
    });

    actualStep = document.getElementById('step-' + step)
    actualStep.style.display = 'flex';
    actualStep.classList.add('slide-left');

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

    nextBtn.style.display = step === 5 ? 'none' : 'block';
    prevBtn.style.display = step === 1 ? 'none' : 'block';
    verifyBtn.style.display = step !== 1 ? 'none' : 'block';
    submitBtn.style.display = step !== 5 ? 'none' : 'block';

}

function nextStep() {
    if (validateStep(currentStep)) {
        if (currentStep < 5) {
            currentStep++;
            showStep(currentStep);
        }
        if (actualStep.classList.contains('slide-right')) {
            actualStep.classList.remove('slide-right');
            actualStep.classList.add('slide-left');
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        if (actualStep.classList.contains('slide-left')) {
            actualStep.classList.remove('slide-left');
            actualStep.classList.add('slide-right');
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    showStep(currentStep);
});

prevBtn.addEventListener('click', function() {
    prevStep();

});

nextBtn.addEventListener('click', function() {
    nextStep();
});

form.addEventListener('submit', function(event) {
    if (validateStep(currentStep)) {
        const formData = new FormData(event.target);
        const data = {};
        formData.forEach((value, key) => {
            if (key.includes('[]')) {
                const cleanKey = key.replace('[]', '');
                if (!data[cleanKey]) {
                    data[cleanKey] = [];
                }
                data[cleanKey].push(value);
            } else {
                data[key] = value;
            }
        });
        return data;
    } else {
        event.preventDefault();
    }
})

document.addEventListener('DOMContentLoaded', function() {
    const ningunoCheckbox = document.getElementById('ninguno');
    const otherCheckboxes = ['familiar', 'merito', 'otros'].map(id => document.getElementById(id));

    // Cuando se selecciona 'ninguno', deselecciona los otros
    ningunoCheckbox.addEventListener('change', function() {
        if (ningunoCheckbox.checked) {
            otherCheckboxes.forEach(cb => cb.checked = false);
        }
    });

    // Cuando se selecciona cualquiera de los otros, deselecciona 'ninguno'
    otherCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (cb.checked) {
                ningunoCheckbox.checked = false;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const idAlumno = document.getElementById('id_alumno').value;
    const cursoSelect = document.getElementById('curso');
    const radios = document.querySelectorAll('input[name="condicion_alumno"]');
    const radiosAdeudaMateria = document.querySelectorAll('input[name="adeuda_materias"]');
    const options = cursoSelect.querySelectorAll('option');
    const escuelaProviene = document.getElementById('escuela_proviene');
    const nombreMaterias = document.getElementById('nombre_materias');
    let cursoActual = '';
    // Mapeo de los cursos disponibles
    const cursos = ['Primer año', 'Segundo año', 'Tercer año', 'Cuarto año', 'Quinto año', 'Sexto año'];

    radios.forEach(radio => {
        if (!radio.checked) {
            radio.disabled = true; // Deselecciona todos los radios
            if (radio.value !== 'traspaso' && radio.value !== 'ingresante') {
                escuelaProviene.disabled = true;
            }
        }
    });

    function disableCoursesForPreinscripto() {
        cursoActual = cursoSelect.value;
        const indiceCursoActual = cursos.indexOf(cursoActual);
        if (!idAlumno) {
            options.forEach(option => {
                cursoActual = cursoSelect.value;
                if (option.value !== 'Primer año') {
                    option.disabled = true;
                }
            });
        } else {
            options.forEach(option => {
                const indiceOpcion = cursos.indexOf(option.value);
                if (indiceCursoActual === cursos.length - 1) {
                    option.disabled = indiceOpcion !== indiceCursoActual;
                } else {
                    option.disabled = !(indiceOpcion === indiceCursoActual || indiceOpcion ===
                        indiceCursoActual + 1);
                }
            });
        }
    }

    function handleRadioChange() {
        cursoActual;
        const indiceCursoActual = cursos.indexOf(cursoActual);
        radios.forEach(radio => {
            radio.checked = false;
            if (radio.value !== 'traspaso' || radio.value !== 'ingresante') {
                escuelaProviene.disabled = true;
            }
        });

        if (cursoSelect.value !== 'Primer año' && cursoSelect.value !== 'Segundo año' && cursoSelect.value !=="") {
            modalidad.disabled = false;}
            else {
                modalidad.disabled = true;
            };

        if (cursoSelect.value === 'Primer año') {
            radios.forEach(radio => {
                if (radio.value !== 'ingresante' && radio.value !== 'repitente') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else if (indiceCursoActual === cursos.length - 1) {
            radios.forEach(radio => {
                if (radio.value !== 'repitente') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else if (cursoSelect.value === cursos[indiceCursoActual]) {
            radios.forEach(radio => {
                if (radio.value !== 'repitente' && radio.value !== 'traspaso') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else if (cursoSelect.value === cursos[indiceCursoActual + 1]) {
            radios.forEach(radio => {
                if (radio.value !== 'regular') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else {
            radios.forEach(radio => {
                radio.disabled = false;
            });
        }
    }

    function toggleNombreMaterias() {
        const selectedValue = Array.from(radiosAdeudaMateria).find(radio => radio.checked)?.value;
        nombreMaterias.disabled = selectedValue !== '1';
        nombreMaterias.value;
    }
    function disableNombreEscuela() {
        const selectedValue = Array.from(radios).find(radio => radio.checked)?.value;
        escuelaProviene.disabled = selectedValue !== 'traspaso' && selectedValue !== 'ingresante';

    }

    disableCoursesForPreinscripto()
    handleRadioChange()
    toggleNombreMaterias()

    radios.forEach(radio => {
        radio.addEventListener('change', disableNombreEscuela);
    });
    radiosAdeudaMateria.forEach(radio => {
        radio.addEventListener('change', toggleNombreMaterias);
    });
    cursoSelect.addEventListener('change', handleRadioChange);
});

document.addEventListener('DOMContentLoaded', function() {
    const idAlumno = document.getElementById('id_alumno').value;
    const cursoSelect = document.getElementById('curso');
    const radios = document.querySelectorAll('input[name="condicion_alumno"]');
    const radiosAdeudaMateria = document.querySelectorAll('input[name="adeuda_materias"]');
    const options = cursoSelect.querySelectorAll('option');
    const escuelaProviene = document.getElementById('escuela_proviene');
    const nombreMaterias = document.getElementById('nombre_materias');
    let cursoActual = '';
    // Mapeo de los cursos disponibles
    const cursos = ['Primer año', 'Segundo año', 'Tercer año', 'Cuarto año', 'Quinto año', 'Sexto año'];

    radios.forEach(radio => {
        if (!radio.checked) {
            radio.disabled = true; // Deselecciona todos los radios
            if (radio.value !== 'traspaso' && radio.value !== 'ingresante') {
                escuelaProviene.disabled = true;
            }
        }
    });

    function disableCoursesForPreinscripto() {
        cursoActual = cursoSelect.value;
        const indiceCursoActual = cursos.indexOf(cursoActual);
        if (!idAlumno) {
            options.forEach(option => {
                cursoActual = cursoSelect.value;
                if (option.value !== 'Primer año') {
                    option.disabled = true;
                }
            });
        } else {
            options.forEach(option => {
                const indiceOpcion = cursos.indexOf(option.value);
                if (indiceCursoActual === cursos.length - 1) {
                    option.disabled = indiceOpcion !== indiceCursoActual;
                } else {
                    option.disabled = !(indiceOpcion === indiceCursoActual || indiceOpcion ===
                        indiceCursoActual + 1);
                }
            });
        }
    }

    function handleRadioChange() {
        cursoActual;
        const indiceCursoActual = cursos.indexOf(cursoActual);
        radios.forEach(radio => {
            radio.checked = false;
            if (radio.value !== 'traspaso' || radio.value !== 'ingresante') {
                escuelaProviene.disabled = true;
            }
        });

        if (cursoSelect.value === 'Primer año') {
            radios.forEach(radio => {
                if (radio.value !== 'ingresante' && radio.value !== 'repitente') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else if (indiceCursoActual === cursos.length - 1) {
            radios.forEach(radio => {
                if (radio.value !== 'repitente') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else if (cursoSelect.value === cursos[indiceCursoActual]) {
            radios.forEach(radio => {
                if (radio.value !== 'repitente' && radio.value !== 'traspaso') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else if (cursoSelect.value === cursos[indiceCursoActual + 1]) {
            radios.forEach(radio => {
                if (radio.value !== 'regular') {
                    radio.disabled = true;
                } else {
                    radio.disabled = false;
                }
            });
        } else {
            radios.forEach(radio => {
                radio.disabled = false;
            });
        }
    }

    function toggleNombreMaterias() {
        const selectedValue = Array.from(radiosAdeudaMateria).find(radio => radio.checked)?.value;
        nombreMaterias.disabled = selectedValue !== '1';
        nombreMaterias.value;
        if (nombreMaterias.disabled) {
            nombreMaterias.value = ""; // Limpiar el campo
        }
    }
    function disableNombreEscuela() {
        const selectedValue = Array.from(radios).find(radio => radio.checked)?.value;
        escuelaProviene.disabled = selectedValue !== 'traspaso' && selectedValue !== 'ingresante';
        if (escuelaProviene.disabled) {
            escuelaProviene.value = ""; // Limpiar el campo
        }
    }

    disableCoursesForPreinscripto()
    handleRadioChange()
    toggleNombreMaterias()

    radios.forEach(radio => {
        radio.addEventListener('change', disableNombreEscuela);
    });
    radiosAdeudaMateria.forEach(radio => {
        radio.addEventListener('change', toggleNombreMaterias);
    });
    cursoSelect.addEventListener('change', handleRadioChange);
});


document.addEventListener('DOMContentLoaded', function() {
    const departamentoSelect = document.getElementById('departamento');
    const localidadSelect = document.getElementById('localidad');

    // Obtener y ordenar los departamentos alfabéticamente por nombre
    const departamentos = DEPARTAMENTOS[0].departamentos.sort((a, b) => {
        return a.nombre.localeCompare(b.nombre);
    });

    // Llenar el selector de departamentos
    departamentos.forEach(departamento => {
        const option = document.createElement('option');
        option.value = departamento.nombre;
        option.text = departamento.nombre;
        departamentoSelect.appendChild(option);
    });

    // Evento para cuando se selecciona un departamento
    departamentoSelect.addEventListener('change', function() {
        const selectedDepartamentoId = departamentoSelect.value;

        // Limpiar el selector de localidades
        localidadSelect.innerHTML = '';

        // Obtener y ordenar las localidades del departamento seleccionado
        const localidades = LOCALIDADES[0].localidades
            .filter(localidad => localidad.departamento.id === selectedDepartamentoId)
            .sort((a, b) => {
                return a.nombre.localeCompare(b.nombre);
            });

        // Llenar el selector de localidades
        localidades.forEach(localidad => {
            const option = document.createElement('option');
            option.value = localidad.nombre;
            option.text = localidad.nombre;
            localidadSelect.appendChild(option);
        });
    });
;
});

document.addEventListener("DOMContentLoaded", function() {
    const obraSocialSi = document.getElementById("obra_social_si");
    const obraSocialNo = document.getElementById("obra_social_no");
    const nombreObraSocial = document.getElementById("nombre_obra_social");

    function toggleNombreObraSocial() {
        if (obraSocialNo.checked) {
            nombreObraSocial.value = "";
            nombreObraSocial.disabled = true;
        } else {
            nombreObraSocial.disabled = false;
        }
    }

    obraSocialSi.addEventListener("change", toggleNombreObraSocial);
    obraSocialNo.addEventListener("change", toggleNombreObraSocial);

    toggleNombreObraSocial();
});
