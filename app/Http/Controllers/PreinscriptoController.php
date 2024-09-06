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
            'cuil' => 'required|unique:preinscriptos,cuil|min:11|max:11|regex:/^[0-9]{11}$/',
            'email' => 'email|max:100|min:10',
            'telefono' => 'required|min:8|max:15|regex:/^[0-9\s\-]+$/',
            'genero' => 'required|in:Femenino,Masculino,Otro|min:3|max:10',
            'fecha_nac' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->diffInYears(Carbon::now()) < 12) {
                        $fail('El alumno debe ser mayor a 12 años de edad.');
                    } elseif ($date->diffInYears(Carbon::now()) > 17) {
                        $fail('El alumno debe ser menor a 17 años de edad.');
                    }
                }
            ]
        ],  [
            'cuil.required' => 'El cuil es obligatorio',
            'cuil.unique' =>'El cuil ya existe',
            'cuil.min'=>'El cuil debe tener 11 caracteres',
            'cuil.max'=>'El cuil debe tener 11 caracteres',
            'cuil.regex'=>'El cuil debe ser un número de CUIL',
            'cuil.format'=>'El formato del CUIL no es correcto, se esperan 11 numeros',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'nombre.max' => 'El nombre debe tener un máximo de 20 caracteres',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.min' => 'Apellido debe tener un mínimo de 3 caracteres',
            'apellido.max' => 'Apellido debe tener un máximo de 20 caracteres',
            'genero.required' => 'Debe seleccionar un género',
            'genero.in' => 'El género seleccionado no es válido.',
            'fecha_nac.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nac.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida',
            'email.max' => 'El email debe tener un máximo de 100 caracteres',
            'email.min' => 'El email debe tener un mínimo de 10 caracteres',
            'email.format' => 'El formato del email no es correcto',
            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.max' => 'El teléfono debe tener un máximo de 15 números',
            'telefono.min' => 'El teléfono debe tener un mínimo de 8 números',
            'telefono.regex' => 'El teléfono debe ser un número válido de teléfono',
            'telefono.format' => 'El formato del teléfono no es correcto, se esperan al menos 8 números',
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
                'comprobante_preinscripcion' => $this->generarCodigoComprobante($req->input('cuil'),$req->input('fecha_nac')),
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
            return response()->json(['mensaje' => 'Cuil encontrado. <br/> Usted será redirigido al formulario de inscripción.', 'encontrado' => true]);
        } else {
            return response()->json(['mensaje' => 'Cuil no encontrado', 'encontrado' => false]);
        }
    }

    public function generarCodigoComprobante($cuil, $fecha_insc){
        $codigoComprobante = $cuil . $fecha_insc;
        return $codigoComprobante;
    }

    public function generarPdf()
    {
        $preinscripto = Session::get('preinscripto');
        $pdf = Pdf::loadView('comprobantes.comprobante-preinscripto', compact('preinscripto'));
        return $pdf->download('comprobante-preinscripcion.pdf');
    }
}
