<?php

namespace App\Livewire;

use App\Models\DatoEstudiante;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Tutor;
use Livewire\Component;

class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $total_steps = 5;
    /* STEP 1 */
    public $nombre;
    public $apellido;
    public $genero = "";
    public $fecha_nac;
    public $email;
    public $telefono;
    /* STEP 2 */
    public $calle;
    public $numeracion;
    public $piso;
    public $localidad;
    public $ciudad;
    public $provincia;
    public $transporte=[];
    public $convive=[];
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
    public $curso = "";
    public $modalidad = "";
    public $escuelaProviene;
    public $turno;
    public $condicionAlumno;
    public $adeudaMaterias;
    public $nombreMaterias;
    /* STEP 5 */
    public $reconocimientos=[];
    public $terminos;

    public function render()
    {
        return view('livewire.multi-step-form');
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
        try {
            Estudiante::create([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'genero' => $this->genero,
                'cuil' => $this->cuil,
                'email' => $this->email,
                'fecha_nac' => $this->fecha_nac,
            ]);

            DatoEstudiante::create([
                'telefono' => $this->telefono,
                'provincias' => $this->provincias,
                'ciudad' => $this->ciudad,
                'localidad' => $this->localidad,
                'calle' => $this->calle,
                'numeracion' => $this->numeracion,
                'piso' => $this->piso,
                'lugar_nacimiento' => $this->lugar_nacimiento,
                'nombre_obra_social' => $this->nombreObraSocial,
                'obra_social' => $this->obraSocial,
                'fecha_ingreso' => $this->fecha_ingreso,
                'medio_transporte' => json_encode($this->transporte),
                'convivencia' => json_encode($this->convive),
            ]);

            Inscripcion::create([
                'turno' => $this->turno,
                'curso_inscripto' => $this->curso,
                'modalidad' => $this->modalidad,
                'escuela_proviene' => $this->escuelaProviene,
                'fecha_inscripto' => now(),
                'condicion_alumno' => $this->condicionAlumno,
                'adeuda_materias' => $this->adeudaMaterias,
                'nombre_materias' => $this->nombreMaterias,
                'reconocimientos' => json_encode($this->reconocimientos),
            ]);

            Tutor::create([
                'nombre' => $this->nombreTutor,
                'apellido' => $this->apellidoTutor,
                'cuil' => $this->cuilTutor,
                'email' => $this->emailTutor,
                'telefono' => $this->telefonoTutor,
                'ocupacion' => $this->ocupacion,
                'parentezco' => $this->parentezco,
            ]);
            } catch (\Exception $e){
                return redirect()->back()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
            }

        dd([
            'Step 1' => [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'genero' => $this->genero,
                'fecha_nac' => $this->fecha_nac,
                'email' => $this->email,
                'telefono' => $this->telefono
            ],
            'Step 2' => [
                'calle' => $this->calle,
                'numeracion' => $this->numeracion,
                'piso' => $this->piso,
                'localidad' => $this->localidad,
                'provincia' => $this->provincia,
                'ciudad' => $this->ciudad,
                'transporte' => $this->transporte,
                'convive' => $this->convive,
                'obraSocial' => $this->obraSocial,
                'nombreObraSocial' => $this->nombreObraSocial
            ],
            'Step 3' => [
                'nombreTutor' => $this->nombreTutor,
                'apellidoTutor' => $this->apellidoTutor,
                'cuilTutor' => $this->cuilTutor,
                'emailTutor' => $this->emailTutor,
                'telefonoTutor' => $this->telefonoTutor,
                'ocupacion' => $this->ocupacion,
                'parentezco' => $this->parentezco
            ],
            'Step 4' => [
                'curso' => $this->curso,
                'modalidad' => $this->modalidad,
                'escuelaProviene' => $this->escuelaProviene,
                'turno' => $this->turno,
                'condicionAlumno' => $this->condicionAlumno,
                'adeudaMaterias' => $this->adeudaMaterias,
                'nombreMaterias' => $this->nombreMaterias
            ],
            'Step 5' => [
                'reconocimientos' => $this->reconocimientos,
                'terminos' => $this->terminos
            ]
        ]);

        //$this->reset();
    }

    public function validateForm()
    {
        if ($this->currentStep === 1) {
            $validated = $this->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'genero' => 'required',
                'fecha_nac' => 'required',
                'email' => 'required',
                'telefono' => 'required'
            ]);
        } elseif ($this->currentStep === 2) {
            $validated = $this->validate([
                'domicilio' => 'required',
                'ciudad' => 'required',
                'transporte' => 'required',
                'convive' => 'required',
                'obraSocial' => 'required',
            ]);
        } elseif ($this->currentStep === 3) {
            $validated = $this->validate([
                'nombreTutor' => 'required',
                'apellidoTutor' => 'required',
                'cuilTutor' => 'required',
                'emailTutor' => 'required',
                'telefonoTutor' => 'required',
                'ocupacion' => 'required',
                'parentezco' => 'required',
            ]);
        } elseif ($this->currentStep === 4) {
            $validated = $this->validate([
                'curso' => 'required',
                'modalidad' => 'required',
                'escuelaProviene' => 'required',
                'turno' => 'required',
                'condicionAlumno' => 'required',
                'adeudaMaterias' => 'required',
            ]);
        } elseif ($this->currentStep === 5) {
            $validated = $this->validate([
                'reconocimientos' => 'required',
                'terminos' => 'required',
            ]);
        }
    }
}
