<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InscripcionController extends Controller
{

    public function convivenciaPdf()
    {
        $archivo = storage_path("codigo_convivencia.pdf");

        return response()->file($archivo);
    }
    public function index()
    {
        $preinscripto = Session::get('preinscripto');
        $inscripto = Session::get('estudiante');

        $data = $inscripto ? $inscripto : $preinscripto;
        return view('formulario.inscripcion-form', compact('data'));
    }
    public function store(Request $request)
    {
        //Todo:
        /**
         * *Todo: Crear nuevo estudiante. Crearlo mediante las relaciones
         * *$estudiante= Estudiante::create(...)
         * *$estudiante->tutor()->create(...)
         * *$estudiante->dato()->create(...)
         * *$estudiante->inscripciones()->create(...)
         **/
        dd($request->input());
    }
    public function update(Request $request)
    {
        //Todo:
        /**
         * *Actualizar estudiante y crear una nueva inscripcion, no actualizarla
         * *$estudiante= Estudiante::update(...)
         * *$estudiante->tutor()->update(...)
         * *$estudiante->dato()->update(...)
         * *$estudiante->inscripciones()->create(...)
         **/
        dd($request->input());
    }
}
