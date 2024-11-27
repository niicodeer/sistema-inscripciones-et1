<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Tutor;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class InscripcionController extends Controller
{

    public function generarCodigoComprobante($cuil)
    {
        $now = Carbon::now()->timestamp;
        return $cuil . $now;
    }

    public function generarPdf()
    {
        $preinscripto = Session::get('preinscripto');
        $inscripcion = Session::get('data-inscripcion');
        $inscripto = Session::get('estudiante');
        $data = $inscripto ? $inscripto : $preinscripto;

        $pdf = Pdf::loadView('comprobantes.comprobante-inscripto', compact('inscripcion', 'data'));
        return $pdf->download('comprobante-inscripcion.pdf');
    }

    public function convivenciaPdf()
    {
        $archivo = storage_path("codigo_convivencia.pdf");

        return response()->file($archivo);
    }
    public function index()
    {
        $preinscripto = Session::get('preinscripto');
        $inscripto = Session::get('estudiante');

        $data = $inscripto ? $inscripto : $preinscripto;
        return view('formulario.inscripcion-form', compact('data'));
    }

    public function validateForm(Request $request)
    {
        return $request->validate(
            [
                // Estudiante
                'nombre_alumno' => 'required|string|min:3|max:50',
                'apellido_alumno' => 'required|string|min:3|max:50',
                'genero_alumno' => 'required|in:Femenino,Masculino,Otro',
                'fecha_nac_alumno' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        $date = Carbon::parse($value);
                        if ($date->diffInYears(Carbon::now()) < 12) {
                            $fail('La fecha de nacimiento debe ser al menos 12 años menor al año actual.');
                        }
                    }
                ],
                'email_alumno' => 'required|email|min:8|max:100',
                'telefono_alumno' => 'required|string|min:8|max:15',
                'cuil_alumno' => 'required|string|size:11',

                // Tutor
                'nombre_tutor' => 'required|string|min:3|max:50',
                'apellido_tutor' => 'required|string|min:3|max:50',
                'cuil_tutor' => 'required|string|size:11',
                'email_tutor' => 'required|email|min:8|max:100',
                'telefono_tutor' => 'required|string|min:8|max:15',
                'ocupacion_tutor' => 'required|string|min:5|max:30',
                'parentezco' => 'required|string|min:3|max:20',

                // Datos Estudiante - Inscripción
                'calle' => 'required|string|min:5|max:100',
                'departamento' => 'required|string',
                'localidad' => 'required|string',
                'barrio' => 'required|string|min:5|max:50',
                'numeracion' => 'required|numeric',
                'piso' => 'nullable',
                'transporte' => 'required|array',
                'convive' => 'required|array',
                'obra_social' => 'required|boolean',
                'nombre_obra_social' => 'required_if:obra_social,true|nullable|string',
                'curso' => 'required|in:Primer año,Segundo año,Tercer año,Cuarto año,Quinto año,Sexto año', // Sin comillas dobles
                'modalidad' => 'nullable|required_if:curso,Tercer año,Cuarto año,Quinto año,Sexto año',
                'condicion_alumno' => 'required',
                'escuela_proviene' => 'required_if:condicion_alumno,traspaso,ingresante|nullable|string', // Añadí validación más estricta
                'turno' => 'required|in:Mañana,Tarde,Noche',
                'adeuda_materias' => 'required|boolean',
                'nombre_materias' => 'required_if:adeuda_materias,true|nullable|string',
                //'condicion_inscripcion' => 'required|array', // Cambiado a `array` si es un conjunto de opciones
                /* 'condicion_inscripcion' => [
                    Rule::requiredIf(function () use ($request) {
                        return !$request->has('id_alumno');
                    }),'array'], */
            ],
            [
                'nombre_alumno.required' => 'El nombre del alumno es obligatorio y debe tener entre 3 y 50 caracteres.',
                'apellido_alumno.required' => 'El apellido del alumno es obligatorio y debe tener entre 3 y 50 caracteres.',
                'genero_alumno.required' => 'El género es obligatorio y debe ser "Femenino", "Masculino" o "Otro".',
                'genero_alumno.in' => 'El género debe ser "Femenino", "Masculino" o "Otro".',
                'fecha_nac_alumno.required' => 'La fecha de nacimiento es obligatoria.',
                'fecha_nac_alumno.date' => 'La fecha de nacimiento debe ser una fecha válida.',
                'email_alumno.required' => 'El email del alumno es obligatorio y debe ser válido.',
                'email_alumno.email' => 'El email debe ser una dirección válida.',
                'telefono_alumno.required' => 'El número de teléfono del alumno es obligatorio y debe tener entre 8 y 15 caracteres.',
                'cuil_alumno.required' => 'El CUIL del alumno es obligatorio y debe tener 11 caracteres.',

                // Tutor
                'nombre_tutor.required' => 'El nombre del tutor es obligatorio y debe tener entre 3 y 50 caracteres.',
                'apellido_tutor.required' => 'El apellido del tutor es obligatorio y debe tener entre 3 y 50 caracteres.',
                'cuil_tutor.required' => 'El CUIL del tutor es obligatorio y debe tener 11 caracteres.',
                'email_tutor.required' => 'El email del tutor es obligatorio y debe ser válido.',
                'email_tutor.email' => 'El email debe ser una dirección válida.',
                'telefono_tutor.required' => 'El número de teléfono del tutor es obligatorio y debe tener entre 8 y 15 caracteres.',
                'ocupacion_tutor.required' => 'La ocupación del tutor es obligatoria y debe tener entre 5 y 30 caracteres.',
                'parentezco.required' => 'El parentesco con el estudiante es obligatorio.',

                // Datos Estudiante - Inscripción
                'calle.required' => 'La calle es obligatoria y debe tener entre 5 y 100 caracteres.',
                'departamento.required' => 'La departamento es obligatoria.',
                'localidad.required' => 'La localidad es obligatoria.',
                'barrio.required' => 'El barrio es obligatorio y debe tener entre 5 y 100 caracteres.',
                'numeracion.required' => 'La numeración de la dirección es obligatoria y debe ser numérica.',
                'transporte.required' => 'El medio de transporte es obligatorio.',
                'convivencia.required' => 'El campo de convivencia es obligatorio.',
                'obra_social.required' => 'La obra social es obligatoria.',
                'curso.required' => 'El curso es obligatorio y debe ser uno de: "Primer año", "Segundo año", "Tercer año", "Cuarto año", "Quinto año", "Sexto año".',
                'modalidad.in' => 'La modalidad debe ser "Informática", "Economía" o "Industria".',
                'condicion_alumno.required' => 'La condición del alumno es obligatoria.',
                'turno.required' => 'El turno es obligatorio.',
                'adeuda_materias.required' => 'Es necesario indicar si el alumno adeuda materias.',
                'nombre_materias.required_if' => 'Debe especificar las materias que adeuda.',
                'condicion_inscripcion.required' => 'La condición de inscripción es obligatoria.',
                'nombre_obra_social.required_if' => 'Debe especificar el nombre de la obra social.',
                'escuela_proviene.required_if' => 'Debe especificar la escuela de procedencia.',
            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $this->validateForm($request);
        try {
            DB::beginTransaction();
            $tutor = Tutor::create([
                'nombre' => $validated['nombre_tutor'],
                'apellido' => $validated['apellido_tutor'],
                'cuil' => $validated['cuil_tutor'],
                'email' => $validated['email_tutor'],
                'telefono' => $validated['telefono_tutor'],
                'ocupacion' => $validated['ocupacion_tutor'],
                'parentezco' => $validated['parentezco'],
            ]);

            $estudiante = Estudiante::create([
                'nombre' => $validated['nombre_alumno'],
                'apellido' => $validated['apellido_alumno'],
                'genero' => $validated['genero_alumno'],
                'cuil' => $validated['cuil_alumno'],
                'telefono' => $validated['telefono_alumno'],
                'email' => $validated['email_alumno'],
                'fecha_nac' => $validated['fecha_nac_alumno'],
                'tutor_id' => $tutor->id,
            ]);

            $estudiante->dato()->create([
                'departamento' => $validated['departamento'],
                'localidad' => $validated['localidad'],
                'barrio' => $validated['barrio'],
                'calle' => $validated['calle'],
                'numeracion' => $validated['numeracion'],
                'piso' => $validated['piso'],
                /* 'lugar_nacimiento' => $validated['lugar_nacimiento'] ?? 'Desconocido', */
                'obra_social' => $validated['obra_social'],
                'nombre_obra_social' => $validated['obra_social'] ? $validated['nombre_obra_social'] : null,
                'medio_transporte' => json_encode($validated['transporte']),
                'convivencia' => json_encode($validated['convive']),
            ]);

            $inscripcion = $estudiante->inscripciones()->create([
                'turno' => $validated['turno'],
                'curso_inscripto' => $validated['curso'],
                'modalidad' => $validated['modalidad'] ?? null,
                'escuela_proviene' => in_array($validated['condicion_alumno'], ['traspaso', 'ingresante']) ? $validated['escuela_proviene'] : null,
                'fecha_inscripcion' => now(),
                'condicion_alumno' => $validated['condicion_alumno'],
                'adeuda_materias' => $validated['adeuda_materias'],
                'nombre_materias' => $validated['adeuda_materias'] ? $validated['nombre_materias'] : null,
                'reconocimientos' => json_encode($validated['condicion_inscripcion']),
                'comprobante_inscripcion' => $this->generarCodigoComprobante($validated['cuil_alumno']),
            ]);

            DB::commit();
            Session::put('data-inscripcion', $inscripcion->only($inscripcion->getFillable()));

            return redirect()->route('confirmacion-inscripcion')->with('success', 'Se registró tu inscripción correctamente');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            Log::error('Error en la inscripción: ' . $e->getMessage());
            return redirect()->route('inscripcion')->with('error', 'Ocurrió un error al registrar la inscripción. Vuelve a intentarlo o intenta más tarde')->withInput();
        }
    }
    public function update(Request $request)
    {
        $validated = $this->validateForm($request);
        //dd($validated);
        $id_alumno = $request->validate([
            'id_alumno' => 'required|integer|exists:estudiantes,id',
        ]);
        try {
            DB::beginTransaction();

            $estudiante = Estudiante::find($id_alumno)->first();
            $estudiante->update([
                'nombre' => $validated['nombre_alumno'],
                'apellido' => $validated['apellido_alumno'],
                'genero' => $validated['genero_alumno'],
                'telefono' => $validated['telefono_alumno'],
                'email' => $validated['email_alumno'],
                'fecha_nac' => $validated['fecha_nac_alumno'],
            ]);

            $estudiante->tutor()->update([
                'nombre' => $validated['nombre_tutor'],
                'apellido' => $validated['apellido_tutor'],
                'cuil' => $validated['cuil_tutor'],
                'email' => $validated['email_tutor'],
                'telefono' => $validated['telefono_tutor'],
                'ocupacion' => $validated['ocupacion_tutor'],
                'parentezco' => $validated['parentezco'],
            ]);

            $estudiante->dato()->update([
                'departamento' => $validated['departamento'],
                'localidad' => $validated['localidad'],
                'barrio' => $validated['barrio'],
                'calle' => $validated['calle'],
                'numeracion' => $validated['numeracion'],
                'piso' => $validated['piso'],
                'nombre_obra_social' => $validated['obra_social'] ? $validated['nombre_obra_social'] : null,
                'obra_social' => $validated['obra_social'],
                'medio_transporte' => json_encode($validated['transporte']),
                'convivencia' => json_encode($validated['convive']),
            ]);

            $inscripcion = $estudiante->inscripciones()->create([
                'turno' => $validated['turno'],
                'curso_inscripto' => $validated['curso'],
                'modalidad' => $validated['modalidad'] ?? null,
                'escuela_proviene' => $request->input('escuela_proviene'), //TODO: cambiar
                'fecha_inscripcion' => now(),
                'condicion_alumno' => $validated['condicion_alumno'],
                'adeuda_materias' => $validated['adeuda_materias'],
                'nombre_materias' => $validated['adeuda_materias'] ? $validated['nombre_materias'] : null,
                'reconocimientos' => json_encode($validated['condicion_inscripcion']),
                'comprobante_inscripcion' => $this->generarCodigoComprobante($validated['cuil_alumno']),
            ]);

            DB::commit();
            Session::put('data-inscripcion', $inscripcion->only($inscripcion->getFillable()));

            return redirect()->route('confirmacion-inscripcion')->with('success', 'Se registró tu inscripción correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            Log::error('Error al actualizar inscripción: ' . $e->getMessage());
            return redirect()->route('inscripcion')->with('error', 'Ocurrió un error al registrar la inscripción. Vuelve a intentarlo o intenta más tarde')->withInput();
        }
    }

    public function incripcion_correcta(){
        return view('confirmacion.confirmacion-inscripcion');
    }
}
