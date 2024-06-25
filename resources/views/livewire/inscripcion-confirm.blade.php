@section('title', 'Inscripción correcta')
<div class="flex flex-col gap-8 justify-center items-center w-full max-w-96 text-center">

    <h1 class="text-2xl md:text-3xl font-bold">Tu inscripción ha sido registrada</h1>
    <p class="">Gracias por inscribirte en nuestra institución! Ya recibimos tu solicitud y está en proceso de
        revisión.
        <br />
        <br />
        En las próximas horas recibirás un mail al correo que proporcionaste con el estado de tu solicitud y con la
        fecha y hora en la que debes presentarte con la documentación requerida. ¡Recordá comprobar tu bandeja de
        entrada como la bandeja de Spam!
        <br />
        <br />
        Puedes cerrar la ventana o inscribir a otra persona en caso que lo necesites
    </p>
    <div class="flex gap-2 flex-col items-center">
        <a class="p-4 text-base font-bold text-[#202020] bg-[#EA9010] max-w-80 w-full rounded-md hover:bg-opacity-80 shadow-md " href="{{route('generarPdfInscripto')}}">Descargar comprobante</a>
        <a class="p-4 text-base font-bold text-[#202020] bg-[#EA9010] max-w-80 w-full rounded-md hover:bg-opacity-80 shadow-md "
            href="{{ route('finalizar') }}">
            Finalizar
        </a>
    </div>
</div>
