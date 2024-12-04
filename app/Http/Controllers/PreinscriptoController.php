<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Preinscripto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PreinscriptoController extends Controller
{

    public function index()
    {
        return view('formulario.preinscripcion-form');
    }

    public function store(Request $req)
    {
        $req->validate([
            'nombre' => 'required|min:3|max:50|string',
            'apellido' => 'required|min:3|max:50|string',
            'cuil' => 'required|unique:preinscriptos,cuil|min:11|max:11|regex:/^[0-9]{11}$/',
            'email' => 'nullable|email|max:100|min:10',
            'telefono' => 'required|min:8|max:15|regex:/^[0-9\s\-]+$/',
            'genero' => 'required|in:Femenino,Masculino,Otro|max:10',
            'condicion_preinscripcion' => 'required',
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
            'cuil.required' => 'El CUIL es obligatorio',
            'cuil.unique' => 'El CUIL ya existe',
            'cuil.min' => 'El CUIL debe tener 11 caracteres',
            'cuil.max' => 'El CUIL debe tener 11 caracteres',
            'cuil.regex' => 'El CUIL debe ser un número de CUIL válido',
            'cuil.format' => 'El formato del CUIL no es correcto, se esperan 11 numeros',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'nombre.max' => 'El nombre debe tener un máximo de 50 caracteres',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.min' => 'Apellido debe tener un mínimo de 3 caracteres',
            'apellido.max' => 'Apellido debe tener un máximo de 50 caracteres',
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
            'condicion_preinscripcion' => 'Debe seleccionar una opción',
        ]);
        try {
            $preinscripto = Preinscripto::create(
                [
                    'cuil' => $req->input('cuil'),
                    'nombre' => $req->input('nombre'),
                    'apellido' => $req->input('apellido'),
                    'email' => strtolower($req->input('email')),
                    'telefono' => $req->input('telefono'),
                    'genero' => $req->input('genero'),
                    'fecha_nac' => $req->input('fecha_nac'),
                    'condicion_preinscripcion' => $req->input('condicion_preinscripcion'),
                    'comprobante_preinscripcion' => $this->generarCodigoComprobante($req->input('cuil')),
                ]
            );
            $req->session()->put('preinscripto', $preinscripto->toArray());
            $req->session()->put('preinscripcion_submitted', true);

            return redirect()->route('confirmacion-preinscripcion')->with('success', 'Preinscripción registrada correctamente.');
        } catch (Exception $e) {
            Log::error('Error en la preinscripción: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la preinscripción.')->withInput();
        }
    }

    public function preincripcion_correcta(){
        return view('confirmacion.confirmacion-preinscripcion');
    }

    public function verificarCUIL(Request $request)
    {
        $cuil = $request->input('cuil');
        $preinscripto = Preinscripto::where('cuil', $cuil)->first();
        $estudiante = Estudiante::with('tutor', 'dato', 'ultimaInscripcion')->where('cuil', $cuil)->first();

        if ($estudiante || $preinscripto) {
            if ($preinscripto) {
                $preinscriptoArray = $preinscripto->only($preinscripto->getFillable());
                $preinscriptoArray['method'] = 'POST';
                Session::put('preinscripto', $preinscriptoArray);
            }

            if ($estudiante) {
                $estudianteArray = $estudiante->toArray();
                $estudianteArray['method'] = 'PUT';
                Session::put('estudiante', $estudianteArray);
            }

            $request->session()->put('cuilCheck', true);
            return response()->json(['mensaje' => 'CUIL encontrado. <br/> Usted será redirigido al formulario de inscripción.', 'encontrado' => true]);
        } else {
            return response()->json(['mensaje' => 'CUIL no encontrado', 'encontrado' => false]);
        }
    }

    public function generarCodigoComprobante($cuil)
    {
        $now = Carbon::now()->timestamp;
        return $cuil . $now;
    }

    public function generarPdf()
    {
        $preinscripto = Session::get('preinscripto');
        $pdf = Pdf::loadView('comprobantes.comprobante-preinscripto', compact('preinscripto'));
        return $pdf->download('comprobante-preinscripcion.pdf');
    }

    public function delete($id)
    {
        $dato = Preinscripto::find($id);
        if (!$dato) {
            return response()->json(['message' => 'No se encontro'], 404);
        }
        $dato->delete();
        return response()->json(['message' => 'Borrado'], 200);
    }

    public function restore($id)
    {
        $dato = Preinscripto::onlyTrashed()->find($id);
        if (!$dato) {
            return response()->json(['message' => 'No se encontro'], 404);
        }
        $dato->restore();
        return response()->json(['message' => 'Restaurado'], 200);
    }
}
