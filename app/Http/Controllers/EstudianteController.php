<?php

namespace App\Http\Controllers;

use App\Models\DatoEstudiante;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index(){
        $estudiante = Estudiante::with('dato')->findOrFail(2);



        return view('estudiante.index', compact('estudiante'));
    }


}
