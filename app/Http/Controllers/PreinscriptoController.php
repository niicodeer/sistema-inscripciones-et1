<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreinscripcionRequest;
use App\Models\Estudiante;
use App\Models\Preinscripto;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;

class PreinscriptoController extends Controller
{

    public function index()
    {
        return view('formulario.preinscripcion-form');
    }

    public function store(PreinscripcionRequest $req)
    {
        try {
            $preinscripto = Preinscripto::create([
                'cuil' => $req->input('cuil'),
                'nombre' => $req->input('nombre'),
                'apellido' => $req->input('apellido'),
                'email' => $req->input('email'),
                'telefono' => $req->input('telefono'),
                'genero' => $req->input('genero'),
                'fecha_nac' => $req->input('fecha_nac'),
                'comprobante_preinscripcion' => $this->generarCodigoComprobante($req->input('cuil'), $req->input('fecha_nac')),
            ]);
        
            $req->session()->put('preinscripto', $preinscripto->toArray());
            $req->session()->put('preinscripcion_submitted', true);
        
            
            return redirect()->route('confirmacion-preinscripcion')->with('status', 'Preinscripción exitosa.');
        } catch (Exception $e) {
            
            return redirect()->back()->with('status', 'Error en la preinscripción: ' . $e->getMessage());
        }
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
