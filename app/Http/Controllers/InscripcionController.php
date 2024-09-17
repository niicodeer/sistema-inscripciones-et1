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
        $inscripto = Session::get('inscripto');
        $data = $inscripto ? $inscripto : $preinscripto;
        return view('formulario.inscripcion-form', compact('data'));
    }
    public function store(Request $request)
    {
        dd($request);
    }
}
