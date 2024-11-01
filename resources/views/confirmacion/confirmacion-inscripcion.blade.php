@extends('layouts.forms-layout')
@section('title', 'Inscripción correcta')
@section('html-style')
    style="height:100%;"
@endsection
@section('content')
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
        <a class="btn bg-primary-color text-text-title" href="{{route('generarPdfInscripto')}}" target="_blank">Descargar comprobante</a>
        <x-secondary-button text="Finalizar" href="{{ route('finalizar') }}" />
    </div>
</div>
@endsection
