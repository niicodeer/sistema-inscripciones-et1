<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Preinscripto;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
            'cuil' => 'required|min:11|max:11|regex:/^[0-9]{11}$/',
            'email' => 'required|email|max:100',
            'telefono' => 'required|min:8|max:15|regex:/^[0-9\s\-]+$/',
            'genero' => 'required|in:Femenino,Masculino,Otro|min:3|max:10',
            'fecha_nac' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->diffInYears(Carbon::now()) < 12) {
                        $fail('La fecha de nacimiento debe ser al menos 12 años menor al año actual.');
                    }
                }
            ]
        ],  [
            'cuil.required' => 'El campo cuil es obligatorio',
            'cuil.min'=>'El cuil debe tener 11 caracteres',
            'cuil.max'=>'El cuil debe tener 11 caracteres',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'Nombre debe tener un mínimo de 3 caracteres',
            'nombre.max' => 'Nombre debe tener un máximo de 20 caracteres',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.min' => 'Apellido debe tener un mínimo de 3 caracteres',
            'apellido.max' => 'Apellido debe tener un máximo de 20 caracteres',
            'genero.required' => 'Debe seleccionar un género.',
            'genero.in' => 'El género seleccionado no es válido.',
            'fecha_nac.required' => 'El campo fecha de nacimiento es obligatorio.',
            'fecha_nac.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.max' => 'Teléfono debe tener un máximo de 15 caracteres'
        ]);
        $preinscripto = Preinscripto::create(
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
        $req->session()->put('preinscripto', $preinscripto->toArray());
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

    public function generarPdf()
    {
        $preinscripto = Session::get('preinscripto');
        $pdf = Pdf::loadView('comprobantes.comprobante-preinscripto', compact('preinscripto'));
        return $pdf->stream();
        //return $pdf->download('comprobante-preinscripcion.pdf');
    }
}
