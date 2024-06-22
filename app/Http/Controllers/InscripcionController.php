<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscripcionController extends Controller
{

    public function convivenciaPdf()
    {
        $archivo = storage_path("codigo_convivencia.pdf");

        return response()->file($archivo);
    }
    /* public function index()
    {
        $step = 1;
        return view('formulario.inscripcion-form', compact('step'));
    } */
}
