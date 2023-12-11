<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index(){
        $estudiante = Estudiante::with("tutor")->findOrFail(10);
        return view ("estudiante.index",["estudiante" => $estudiante]);
    }
}
