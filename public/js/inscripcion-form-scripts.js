let currentStep = 1;
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
    if (currentStep < 5) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    showStep(currentStep);
});
prevBtn.addEventListener('click', function() {
    prevStep();
    if (actualStep.classList.contains('slide-left')) {
        actualStep.classList.remove('slide-left');
        actualStep.classList.add('slide-right');
    }
})
nextBtn.addEventListener('click', function() {
    nextStep();
    if (actualStep.classList.contains('slide-right')) {
        actualStep.classList.remove('slide-right');
        actualStep.classList.add('slide-left');
    }
})
form.addEventListener('submit', function(event) {
    const formData = new FormData(event.target);
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });
    console.log(data);
    return data;
});
