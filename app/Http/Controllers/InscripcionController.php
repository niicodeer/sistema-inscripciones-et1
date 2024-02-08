<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        return view('formulario.inscripcion-form');
    }
}
