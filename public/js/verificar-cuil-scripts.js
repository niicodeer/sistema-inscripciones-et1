document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const mensajeDiv = document.getElementById('mensaje');
    const btnComprobar = document.getElementById('btn-comprobar');
    const btnContinuar = document.getElementById('btn-continuar');
    const btnLoader = document.getElementById('btn-loader');
    const svgCheck = document.getElementById('check-svg');
    const svgCross = document.getElementById('cross-svg');
    const text = document.getElementById('mensaje-text');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        btnComprobar.innerHTML =
            '<div class="mx-auto border-gray-300 h-8 w-8 animate-spin rounded-full border-4 border-t-black"></div>';
        btnComprobar.classList.add('cursor-not-allowed', 'pointer-events-none', 'opacity-50')
        btnComprobar.disabled = true;

        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                btnComprobar.innerHTML = 'Comprobar';
                btnComprobar.classList.remove('cursor-not-allowed', 'pointer-events-none',
                    'opacity-50')
                btnComprobar.disabled = false;

                text.textContent = '';
                mensajeDiv.classList.remove('hidden');
                mensajeDiv.classList.add('flex');
                text.innerHTML += data.mensaje;
                mensajeDiv.style.backgroundColor = data.encontrado ? '#93f844' : '#f25b50';

                if (data.encontrado) {
                    btnComprobar.classList.add('hidden');
                    btnContinuar.classList.remove('hidden');
                    svgCheck.classList.add('block');
                    svgCheck.classList.remove('hidden');
                    svgCross.classList.remove('block');
                    svgCross.classList.add('hidden');

/*                     setTimeout(function() {
                        window.location.href = "/inscripcion";
                    }, 1000); */
                    setTimeout(function() {
                        btnContinuar.classList.remove('cursor-not-allowed',
                            'pointer-events-none', 'bg-[#CCC]');
                        btnContinuar.classList.add('bg-[#EA9010]');
                    }, 1000);

                } else {
                    svgCross.classList.add('block');
                    svgCross.classList.remove('hidden');
                    setTimeout(function() {
                        mensajeDiv.classList.remove('flex');
                        mensajeDiv.classList.add('hidden');
                    }, 1500);
                }

            }).catch(error => {
                console.error('Error:', error.response ? error.response.data : error
                    .message); // Esto captura los errores;
            });
    })
});
