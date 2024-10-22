import { validateStep } from './validaciones.js';

let currentStep = 5;
const form = document.getElementById('multiStepForm');
const steps = form.querySelectorAll('.step');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');
const verifyBtn = document.getElementById('toVerifyBtn');
const submitBtn = document.getElementById('submitBtn');
let actualStep;

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
