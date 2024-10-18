<?php

namespace App\Livewire;


use App\Models\DatoEstudiante;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Tutor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;

use function Laravel\Prompts\alert;

class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $total_steps = 5;
    /* STEP 1 */
    public $nombre;
    public $apellido;
    public $genero = '';
    public $fecha_nac;
    public $email;
    public $telefono;
    public $cuil;
    /* STEP 2 */
    public $calle;
    public $numeracion;
    public $piso;
    public $barrio;
    public $ciudad;
    public $provincia;
    public $transporte = [];
    public $convive = [];
    public $obraSocial;
    public $nombreObraSocial;
    /* STEP 3 */
    public $nombreTutor;
    public $apellidoTutor;
    public $cuilTutor;
    public $emailTutor;
    public $telefonoTutor;
    public $ocupacion;
    public $parentezco;
    /* STEP 4 */
    public $curso = '';
    public $modalidad = '';
    public $escuelaProviene = '';
    public $turno;
    public $condicionAlumno = '';
    public $adeudaMaterias;
    public $nombreMaterias;
    /* STEP 5 */
    public $reconocimientos = [];
    public $terminos;
    public $derechoImagen;

    public function updatedCurso()
    {
        $elijeModalidad = !($this->curso == 'Tercer año' || $this->curso == 'Cuarto año' || $this->curso == 'Quinto año' || $this->curso == 'Sexto año');

        if ($elijeModalidad) {
            $this->modalidad = '';
        }
    }
    public function updateEscuela()
    {
        if ($this->condicionAlumno === 'regular') {
            return $this->escuelaProviene = '';
        }
    }
    public function updateObraSocial()
    {
        if ($this->obraSocial === '0') {
            return $this->nombreObraSocial = '';
        }
    }
    public function updateAdeudaMaterias()
    {
        if ($this->adeudaMaterias === '0') {
            return $this->nombreMaterias = '';
        }
    }

    public function render()
    {
        return view('livewire.multi-step-form');
    }
    public function mount()
    {
        $preinscripto = Session::get('preinscripto');
        $inscripto = Session::get('inscripto');
        $data = $inscripto ? $inscripto : $preinscripto;
        $this->nombre = $data['nombre'];
        $this->apellido = $data['apellido'];
        $this->genero = $data['genero'];
        $this->fecha_nac = $data['fecha_nac'];
        $this->email = $data['email'];
        $this->telefono = $data['telefono'];
        $this->cuil = $data['cuil'];

        //Relleno con los datos del estudiante que hay en la bd
        if ($inscripto) {
            $tutor = Tutor::where('id', $inscripto['tutor_id'])->firstOrFail();
            $this->nombreTutor = $tutor['nombre'];
            $this->apellidoTutor = $tutor['apellido'];
            $this->cuilTutor = $tutor['cuil'];
            $this->emailTutor = $tutor['email'];
            $this->telefonoTutor = $tutor['telefono'];
            $this->ocupacion = $tutor['ocupacion'];
            $this->parentezco = $tutor['parentezco'];

            $datoEstudiante = DatoEstudiante::where('estudiante_id', $inscripto['id'])->firstOrFail();
            $this->provincia = $datoEstudiante['provincia'];
            $this->ciudad = $datoEstudiante['ciudad'];
            $this->barrio = $datoEstudiante['barrio'];
            $this->calle = $datoEstudiante['calle'];
            $this->numeracion = $datoEstudiante['numeracion'];
            $this->piso = $datoEstudiante['piso'];
            //$this->lugar_nacimiento=$datoEstudiante['lugar_nacimiento'];
            $this->nombreObraSocial = $datoEstudiante['nombre_obra_social'];
            $this->obraSocial = $datoEstudiante['obra_social'];
            $this->transporte = json_decode($datoEstudiante['medio_transporte']);
            $this->convive = json_decode($datoEstudiante['convivencia']);

            $inscripcion = Inscripcion::where('estudiante_id', $inscripto['id'])->firstOrFail();
            $this->turno = $inscripcion['turno'];
            $this->curso = $inscripcion['curso_inscripto'];
            $this->modalidad = $inscripcion['modalidad'];
            $this->escuelaProviene = $inscripcion['escuela_proviene'];
            $this->condicionAlumno = $inscripcion['condicion_alumno'];
            $this->adeudaMaterias = $inscripcion['adeuda_materias'];
            $this->nombreMaterias = json_decode($inscripcion['nombre_materias']);
            $this->reconocimientos = json_decode($inscripcion['reconocimientos']);
        }
    }

    public function incrementSteps()
    {
        $this->validateForm();
        if ($this->currentStep < $this->total_steps) {
            $this->currentStep++;
        }
    }

    public function decrementSteps()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        $this->validateForm();
        if ($inscripto = Session::get('inscripto')) {
            try {
                DB::beginTransaction();
                $tutor = Tutor::where('id', $inscripto['tutor_id'])->firstOrFail();
                $tutor->update([
                    'nombre' => $this->nombreTutor,
                    'apellido' => $this->apellidoTutor,
                    'cuil' => $this->cuilTutor,
                    'email' => $this->emailTutor,
                    'telefono' => $this->telefonoTutor,
                    'ocupacion' => $this->ocupacion,
                    'parentezco' => $this->parentezco,
                ]);

                $estudiante = Estudiante::where('id', $inscripto['id'])->firstOrFail();
                $estudiante->update([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'genero' => $this->genero,
                    'cuil' => $this->cuil,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'fecha_nac' => $this->fecha_nac,
                ]);

                $datoEstudiante = DatoEstudiante::where('estudiante_id', $inscripto['id'])->firstOrFail();
                $datoEstudiante->update([
                    'provincia' => $this->provincia,
                    'ciudad' => $this->ciudad,
                    'barrio' => $this->barrio,
                    'calle' => $this->calle,
                    'numeracion' => $this->numeracion,
                    'piso' => $this->piso,
                    'lugar_nacimiento' => 'lugar_nacimiento',
                    'nombre_obra_social' => $this->nombreObraSocial,
                    'obra_social' => $this->obraSocial,
                    'medio_transporte' => json_encode($this->transporte),
                    'convivencia' => json_encode($this->convive),
                ]);

                $inscripcion = Inscripcion::where('estudiante_id', $inscripto['id'])->firstOrFail();
                $inscripcion->update([
                    'turno' => $this->turno,
                    'curso_inscripto' => $this->curso,
                    'modalidad' => $this->modalidad,
                    'escuela_proviene' => $this->escuelaProviene,
                    //'fecha_inscripcion' => now(),
                    'condicion_alumno' => $this->condicionAlumno,
                    'adeuda_materias' => $this->adeudaMaterias,
                    'nombre_materias' => json_encode($this->nombreMaterias),
                    'reconocimientos' => json_encode($this->reconocimientos),
                    'comprobante_inscripcion' => $this->generarCodigoComprobante($this->cuil, $this->fecha_nac),
                ]);
                Session::put('data-inscripcion', $inscripcion->only($inscripcion->getFillable()));

                DB::commit();
                return redirect()->route('confirmacion-inscripcion')->with('success', 'Se registró tu inscripción correctamente');
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->route('inscripcion')->with('error', 'Ocurrió un error al registrar la inscripción. Vuelve a intentarlo o intenta mas tarde');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('inscripcion')->with('error', 'Ocurrió un error al registrar la inscripción. Vuelve a intentarlo o intenta mas tarde');
            }
        }

        if ($preinscripto = Session::get('preinscripto')) {
            try {
                DB::beginTransaction();
                $tutor = Tutor::create([
                    'nombre' => $this->nombreTutor,
                    'apellido' => $this->apellidoTutor,
                    'cuil' => $this->cuilTutor,
                    'email' => $this->emailTutor,
                    'telefono' => $this->telefonoTutor,
                    'ocupacion' => $this->ocupacion,
                    'parentezco' => $this->parentezco,
                ]);

                $estudiante = Estudiante::create([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'genero' => $this->genero,
                    'cuil' => $this->cuil,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'fecha_nac' => $this->fecha_nac,
                    'tutor_id' => $tutor->id,
                ]);

                DatoEstudiante::create([
                    'provincia' => $this->provincia,
                    'ciudad' => $this->ciudad,
                    'barrio' => $this->barrio,
                    'calle' => $this->calle,
                    'numeracion' => $this->numeracion,
                    'piso' => $this->piso,
                    'lugar_nacimiento' => '$this->lugar_nacimiento',
                    'nombre_obra_social' => $this->nombreObraSocial,
                    'obra_social' => $this->obraSocial,
                    'fecha_ingreso' => now(),
                    'medio_transporte' => json_encode($this->transporte),
                    'convivencia' => json_encode($this->convive),
                    'estudiante_id' => $estudiante->id,
                ]);

                $inscripcion = Inscripcion::create([
                    'turno' => $this->turno,
                    'curso_inscripto' => $this->curso,
                    'modalidad' => $this->modalidad,
                    'escuela_proviene' => $this->escuelaProviene,
                    'fecha_inscripcion' => now(),
                    'condicion_alumno' => $this->condicionAlumno,
                    'adeuda_materias' => $this->adeudaMaterias,
                    'nombre_materias' => $this->nombreMaterias,
                    'reconocimientos' => json_encode($this->reconocimientos),
                    'estudiante_id' => $estudiante->id,
                    'comprobante_inscripcion' => $this->generarCodigoComprobante($this->cuil),
                ]);
                Session::put('data-inscripcion', $inscripcion->only($inscripcion->getFillable()));
                DB::commit();

                return redirect()->route('confirmacion-inscripcion')->with('success', 'Se registró tu inscripción correctamente');
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->route('inscripcion')->with('error', 'Ocurrió un error al registrar la inscripción. Vuelve a intentarlo o intenta mas tarde')->withInput();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('inscripcion')->with('error', 'Ocurrió un error al registrar la inscripción. Vuelve a intentarlo o intenta mas tarde')->withInput();
            }
        }

        $this->reset();
    }
}
