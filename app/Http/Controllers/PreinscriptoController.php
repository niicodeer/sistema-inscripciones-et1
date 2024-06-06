<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Preinscripto;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreinscriptoController extends Controller
{

    public function index()
    {
        return view('formulario.preinscripcion-form');
    }

    public function store(Request $req)
    {
        $req->validate([
            'nombre' => 'required|min:3|max:20|string',
            'apellido' => 'required|min:3|max:20|string',
            'cuil' => 'required|min:10|max:12|regex:/^[0-9]{11,12}$/',
            'email' => 'required|email',
            'telefono' => 'required|regex:/^[0-9\s\-]+$/',
            'genero' => 'required',
            'fecha_nac' => 'required'
        ], /* [
            'nombre.required' => 'El campo nombre es requerido. Debe contener entre 3 y 20 caracteres',
            'apellido.required' => 'El campo apellido es requerido. Debe contener entre 3 y 20 caracteres',
            'cuil.required' => 'El campo cuil es requerido. Debe contener ingresar sin puntos ni guiones',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'telefono.required' => 'El campo telefono es requerido.',
            'fecha_nac.required' => 'El campo fecha de nacimiento es requerido.',
            'fecha_nac.date' => 'El formato de fecha de nacimiento no es válido.',
        ] */);
        Preinscripto::create(
            [
                'cuil' => $req->input('cuil'),
                'nombre' => $req->input('nombre'),
                'apellido' => $req->input('apellido'),
                'email' => $req->input('email'),
                'telefono' => $req->input('telefono'),
                'genero' => $req->input('genero'),
                'fecha_nac' => $req->input('fecha_nac'),
            ]
        );
        $req->session()->put('preinscripcion_submitted', true);
        return redirect()->route('confirmacion-preinscripcion');
    }

    public function verificarCUIL(Request $request)
    {
        $cuil = $request->input('cuil');
        $preinscripto = Preinscripto::where('cuil', $cuil)->first();
        $inscripto = Estudiante::where('cuil', $cuil)->first();

        if ($inscripto || $preinscripto) {
            if ($preinscripto) {
                Session::put('preinscripto', $preinscripto->only($preinscripto->getFillable()));
            }

            if ($inscripto) {
                Session::put('inscripto', $inscripto->toArray());
            }

            $request->session()->put('cuilCheck', true);
            return response()->json(['mensaje' => 'Cuil encontrado', 'encontrado' => true]);
        } else {
            return response()->json(['mensaje' => 'Cuil no encontrado', 'encontrado' => false]);
        }
    }

}
