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
    public function index()
    {
        return view('formulario.inscripcion-form');
    }
    public function store(Request $request)
    {
        dd($request);
    }
}
