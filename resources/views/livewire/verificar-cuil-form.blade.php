@section('title', 'Formulario Preinscripción')
<div class="px-2 w-[60%] mx-auto">
    <div>
        <h1 class="text-2xl xl:text-3xl font-bold text-center mb-6 md:mb-14">Inscripciones 2024</h1>
        <p class="text-base text-center text-[#202020]">Ingrese su número de CUIL para comprobar si se encuentra
            pre-inscripto o es alumno de la institución</p>
    </div>
    <form class="flex flex-col gap-y-14 mt-6 items-center w-full" action="{{ route('verificar-cuil') }}" method="POST">
        @csrf
        <div class="w-full flex flex-col gap-2">
            <label for="cuil" class="text-[#2D3648] font-semibold text-sm">CUIL</label>
            <input class="border border-gray-300 p-2 rounded h-10" id= "cuil" name= "cuil"
                placeholder="20-12345678-2" />
            @error('cuil')
                <p class="text-red-700 text-sm">{{ $message }}</p>
            @enderror
            <div id="mensaje" class="items-center justify-center rounded-lg p-2 text-center w-full hidden">
                {{-- usuario encontrado --}}
                <div class="hidden mr-2" id="check-svg">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_96_2905)">
                            <path
                                d="M8.53583 13.595L5 10.0583L6.17833 8.87996L8.53583 11.2366L13.2492 6.52246L14.4283 7.70163L8.53583 13.5933V13.595Z"
                                fill="#1A1A1A" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.833008 9.99967C0.833008 4.93717 4.93717 0.833008 9.99967 0.833008C15.0622 0.833008 19.1663 4.93717 19.1663 9.99967C19.1663 15.0622 15.0622 19.1663 9.99967 19.1663C4.93717 19.1663 0.833008 15.0622 0.833008 9.99967ZM9.99967 17.4997C9.01476 17.4997 8.03949 17.3057 7.12955 16.9288C6.21961 16.5519 5.39281 15.9994 4.69637 15.303C3.99993 14.6065 3.44749 13.7797 3.07058 12.8698C2.69367 11.9599 2.49967 10.9846 2.49967 9.99967C2.49967 9.01476 2.69367 8.03949 3.07058 7.12955C3.44749 6.21961 3.99993 5.39281 4.69637 4.69637C5.39281 3.99993 6.21961 3.44749 7.12955 3.07058C8.03949 2.69367 9.01476 2.49967 9.99967 2.49967C11.9888 2.49967 13.8965 3.28985 15.303 4.69637C16.7095 6.1029 17.4997 8.01055 17.4997 9.99967C17.4997 11.9888 16.7095 13.8965 15.303 15.303C13.8965 16.7095 11.9888 17.4997 9.99967 17.4997Z"
                                fill="#1A1A1A" />
                        </g>
                        <defs>
                            <clipPath id="clip0_96_2905">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                {{-- usuario no encontrado --}}
                <div class="hidden mr-2" id="cross-svg">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.7089 5.37554C15.7801 5.30437 15.8367 5.21985 15.8753 5.12682C15.9139 5.03379 15.9338 4.93407 15.9339 4.83335C15.9339 4.73263 15.9141 4.63288 15.8756 4.5398C15.8372 4.44673 15.7807 4.36214 15.7095 4.29088C15.6384 4.21961 15.5539 4.16307 15.4608 4.12446C15.3678 4.08586 15.2681 4.06596 15.1673 4.0659C15.0666 4.06584 14.9669 4.08562 14.8738 4.1241C14.7807 4.16259 14.6961 4.21903 14.6249 4.29021L9.99954 8.91554L5.37554 4.29021C5.23162 4.14629 5.03642 4.06543 4.83288 4.06543C4.62934 4.06543 4.43413 4.14629 4.29021 4.29021C4.14629 4.43413 4.06543 4.62934 4.06543 4.83288C4.06543 5.03642 4.14629 5.23162 4.29021 5.37554L8.91554 9.99954L4.29021 14.6235C4.21895 14.6948 4.16242 14.7794 4.12385 14.8725C4.08528 14.9656 4.06543 15.0654 4.06543 15.1662C4.06543 15.267 4.08528 15.3668 4.12385 15.4599C4.16242 15.553 4.21895 15.6376 4.29021 15.7089C4.43413 15.8528 4.62934 15.9337 4.83288 15.9337C4.93366 15.9337 5.03345 15.9138 5.12657 15.8752C5.21968 15.8367 5.30428 15.7801 5.37554 15.7089L9.99954 11.0835L14.6249 15.7089C14.7688 15.8526 14.9639 15.9333 15.1673 15.9332C15.3708 15.9331 15.5658 15.8521 15.7095 15.7082C15.8533 15.5643 15.934 15.3692 15.9339 15.1657C15.9337 14.9623 15.8528 14.7673 15.7089 14.6235L11.0835 9.99954L15.7089 5.37554Z"
                            fill="black" />
                    </svg>
                </div>
                <p id="mensaje-text"></p>
            </div>
        </div>
        <x-primary-button text="Comprobar" id="btn-comprobar" />
        <a href="{{ route('inscripcion') }}"
            class="p-4 text-base font-bold text-center text-[#202020] bg-[#EA9010] max-w-80 w-full rounded-md hover:bg-opacity-80 shadow-md hidden"
            id="btn-continuar">
            Continuar
        </a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const mensajeDiv = document.getElementById('mensaje');
        const btnComprobar = document.getElementById('btn-comprobar');
        const btnContinuar = document.getElementById('btn-continuar');
        const svgCheck = document.getElementById('check-svg');
        const svgCross = document.getElementById('cross-svg');
        const text = document.getElementById('mensaje-text')

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
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

                        setTimeout(function() {
                            window.location.href = "{{ route('inscripcion') }}?cuil=" + data.cuil;
                        }, 2000);
                    } else {
                        svgCross.classList.add('block');
                        svgCross.classList.remove('hidden');
                    }

                });
        });
    });
</script>
