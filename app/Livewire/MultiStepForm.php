<?php

namespace App\Livewire;


use App\Models\DatoEstudiante;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Tutor;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class MultiStepForm extends Component
{
    public $currentStep = 4;
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
    public $curso = "";
    public $modalidad = "";
    public $escuelaProviene = "";
    public $turno;
    public $condicionAlumno = '';
    public $adeudaMaterias;
    public $nombreMaterias;
    /* STEP 5 */
    public $reconocimientos = [];
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
        $this->validateForm();
        /* try {

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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        } */

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
                'nombre' => 'required|string|min:3|max:20', // Campo nombre es requerido, debe ser una cadena de caracteres y tener como máximo 255 caracteres
                'apellido' => 'required|string|min:3|max:20', // Campo apellido es requerido, debe ser una cadena de caracteres y tener como máximo 255 caracteres
                'genero' => 'required|in:Femenino,Masculino,Otro|min:3|max:10', // Campo género es requerido y debe ser uno de los valores especificados
                'fecha_nac' => 'required|date', // Campo fecha de nacimiento es requerido y debe ser una fecha válida
                'email' => 'required|email|min:8|max:100', // Campo email es requerido, debe ser un email válido y tener como máximo 255 caracteres
                'telefono' => 'required|string|min:8|max:15', // Campo teléfono es requerido, debe ser una cadena de caracteres y tener como máximo 20 caracteres
            ], [
                'nombre.required' => 'El campo nombre es obligatorio.', //Estos son los mensajes que apareceran en caso de no cumplir
                'apellido.required' => 'El campo apellido es obligatorio.',
                'genero.required' => 'Debe seleccionar un género.',
                'genero.in' => 'El género seleccionado no es válido.',
                'fecha_nac.required' => 'El campo fecha de nacimiento es obligatorio.',
                'fecha_nac.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
                'email.required' => 'El campo email es obligatorio.',
                'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
                'telefono.required' => 'El campo teléfono es obligatorio.',
            ]);
        } elseif ($this->currentStep === 2) {
            $validated = $this->validate([
                'calle' => 'required|string|min:5|max:30',
                'provincia' => 'required|string',
                'ciudad' => 'required|string|min:5|max:20',
                'barrio' => 'required|string|min:5|max:20',
                'numeracion' => 'required|numeric',
                'transporte' => 'required',
                'convive' => 'required',
                'obraSocial' => 'required',
            ], [
                'calle.required' => 'El campo calle es obligatorio.',
                'provincia.required' => 'El campo provincia es obligatorio.',
                'ciudad.required' => 'El campo ciudad es obligatorio.',
                'transporte.required' => 'Debe seleccionar una opción.',
                'numeracion.required' => 'El campo numeración es obligatorio.',
                'localidad.required' => 'El campo localidad es obligatorio.',
                'convive.required' => 'Debe seleccionar una opción.',
                'obraSocial.required' => 'Debe seleccionar una opción.'
            ]);
        } elseif ($this->currentStep === 3) {
            $validated = $this->validate([
                'nombreTutor' => 'required|string|min:3|max:20',
                'apellidoTutor' => 'required|string|min:3|max:20',
                'cuilTutor' => 'required|numeric|max:11',
                'emailTutor' => 'required|email|min:8|max:100',
                'telefonoTutor' => 'required|numeric|max:15',
                'ocupacion' => 'required|string|min:5|max:30',
                'parentezco' => 'required',
            ], [
                'nombreTutor.required' => 'El campo nombre es obligatorio.',
                'apellidoTutor.required' => 'El campo apellido es obligatorio.',
                'cuilTutor.required' => 'El campo cuil es obligatorio.',
                'cuilTutor.numeric' => 'El cuil debe ser numérico, sin puntos ni guiones.',
                'emailTutor.required' => 'El campo email es obligatorio.',
                'emailTutor.email' => 'El email debe ser una dirección de correo electrónico válida.',
                'telefonoTutor.required' => 'El campo telefono es obligatorio',
                'ocupacion.required' => 'El campo ocupación es obligatorio',
                'parentezco.required' => 'Debe seleccionar una opción'
            ]);
        } elseif ($this->currentStep === 4) {
            $validated = $this->validate([
                'curso' => 'required|in:"Primer año","Segundo año","Tercer año","Cuarto año","Quinto año","Sexto año"',
                'modalidad' => 'in:"Informática","Economía","Industria"',
                'condicionAlumno' => 'required',
                'turno' => 'required',
                //'escuelaProviene' => 'required',
                'adeudaMaterias' => 'required',
                //'nombreMaterias' => 'required'
            ], [
                'curso.required' => 'Debe seleccionar una opción.',
                'curso.in' => 'El curso ingresado no es válido.',
                //'modalidad.required' => 'Debe seleccionar una opción.',
                'modalidad.in' => 'La modalidad ingresada no es válida.',
                'turno.required' => 'Debe seleccionar una opción.',
                'adeudaMaterias.required' => 'Debe seleccionar una opción.',
                'condicionAlumno.required' => 'Debe seleccionar una opción.',
                //'escuelaProviene.required' => 'Debe indicar una institución',
                //'nombreMaterias.required' => 'Debe indicar las materias que adeuda',
            ]);
        } elseif ($this->currentStep === 5) {
            $validated = $this->validate([
                'reconocimientos' => 'required',
                'terminos' => 'required',
            ], [
                'reconocimientos.required' => 'Debe seleccionar al menos una opción',
                'terminos.required' => 'Debe seleccionar que leyó y está de acuerdo'
            ]);
        }
    }
}
