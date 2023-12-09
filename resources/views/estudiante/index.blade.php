<h1>{{$estudiante-> nombre}}</h1>
<h2>{{$estudiante-> email}}</h2>
<h2>{{$estudiante-> dato->medioTransporte}}</h2>
<h3>{{$estudiante-> tutor-> cuil}}</h3>

@foreach ($estudiante->inscripciones as $inscripcion)
    <h2>{{$inscripcion->fechaInscripcion}}</h2>
    <h2>{{$inscripcion->curso->turno}}
    <br>
@endforeach 
    

