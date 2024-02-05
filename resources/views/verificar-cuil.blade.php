<form action="{{ route('verificar-cuil') }}" method="POST">
    @csrf
    <label for="cuil">Ingrese Cuil:</label>
    <input type="text" name="cuil" id="cuil">
    <button type="submit">Verificar CUIL</button>
</form>

<div id="mensaje"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const mensajeDiv = document.getElementById('mensaje');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                mensajeDiv.innerHTML = data.mensaje;
            });
        });
    });
</script>
