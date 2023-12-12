<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function prueba(){

        $user = User::with('rol')->findOrFail(2);

        return view('estudiante.index', compact('user'));
    }
}
