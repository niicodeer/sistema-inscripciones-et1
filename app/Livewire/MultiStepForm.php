<?php

namespace App\Livewire;

use App\Models\Curso;
use App\Models\DatoEstudiante;
use App\Models\Estudiante;
use App\Models\Tutor;
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
        //Todo: segun el ejemplo, completar para las tablas necesarias
        //Ejmeplo
        //Tabla(Modelo)::create(['campo_en_bd' => $this->nombreVariable])
        /*
        try{
            Estudiante::create([
                'nombre'=>$this->nombre,
                'apellido'=>$this->apellido,
                ....
            ]);

            DatoEstudiante::create([

            ]);


            Tutor::create([

            ]);

            Inscripcion::create([

            ])

    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
    }

*/

        //Esto es para interrumpir y mostrar en pantalla si se estan guardando los datos en las variables
        //Comentarlo si no lo usan
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
                'nombre' => 'required|string|max:255', // Campo nombre es requerido, debe ser una cadena de caracteres y tener como máximo 255 caracteres
                'apellido' => 'required|string|max:255', // Campo apellido es requerido, debe ser una cadena de caracteres y tener como máximo 255 caracteres
                'genero' => 'required|in:Femenino,Masculino,Otro', // Campo género es requerido y debe ser uno de los valores especificados
                'fecha_nac' => 'required|date', // Campo fecha de nacimiento es requerido y debe ser una fecha válida
                'email' => 'required|email|max:255', // Campo email es requerido, debe ser un email válido y tener como máximo 255 caracteres
                'telefono' => 'required|string|max:20', // Campo teléfono es requerido, debe ser una cadena de caracteres y tener como máximo 20 caracteres
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
            //TODO: segun el ejemplo del paso 1, completar las validaciones de los campos restantes y agregar los campos si faltan
            $validated = $this->validate([
                'calle' => 'required|string',
                'provincia'=>'required|string',
                'ciudad' => 'required|string',
                'localidad'=>'required|string',
                'numeracion' => 'required|numeric',
                'transporte' => 'required',
                'convive' => 'required',
                'obraSocial' => 'required',
            ],[
                'calle.required' => 'El campo calle es obligatorio.',
                'provincia.required'=>'El campo provincia es obligatorio.',
                'ciudad.required'=>'El campo ciudad es obligatorio.',
                'transporte.required'=>'Debe seleccionar una opción.',
                'numeracion.required'=>'El campo numeración es obligatorio.',
                'localidad.required'=>'El campo localidad es obligatorio.',
                'convive.required'=>'Debe seleccionar una opción.',
                'obraSocial.required'=>'Debe seleccionar una opción.'
            ]);
        } elseif ($this->currentStep === 3) {
            $validated = $this->validate([
                'nombreTutor' => 'required|string',
                'apellidoTutor' => 'required|string',
                'cuilTutor' => 'required|numeric',
                'emailTutor' => 'required|email',
                'telefonoTutor' => 'required|nueric',
                'ocupacion' => 'required|stringh',
                'parentezco' => 'required',
            ],[
                'nombreTutor.required'=> 'El campo nombre es obligatorio.',
                'apellidoTutor.required' => 'El campo apellido es obligatorio.',
                'cuilTutor.required'=>'El campo cuil es obligatorio.',
                'cuilTutor.numeric'=>'El cuil debe ser numérico, sin puntos ni guiones.',
                'emailTutor.required'=>'El campo email es obligatorio.',
                'emailTutor.email' => 'El email debe ser una dirección de correo electrónico válida.',
                'telefonoTutor.required' => 'El campo telefono es obligatorio',
                'ocupacion.required' =>'El campo ocupación es obligatorio',
                'parentezco.required' => 'Debe seleccionar una opción'
            ]);
        } elseif ($this->currentStep === 4) {
            $validated = $this->validate([
                'curso' => 'required|in:Primer año, Segundo año, Tercer año, Cuarto año, Quinto año, Sexto año',
                'modalidad' => 'required',
                'escuelaProviene' => 'required',
                'turno' => 'required',
                'condicionAlumno' => 'required',
                'adeudaMaterias' => 'required',
            ],[
                'curso.required'=>'Debe seleccionar una opción.',
                'curso.in'=>'El curso ingresado no es válido.',
                
            ]);
        } elseif ($this->currentStep === 5) {
            $validated = $this->validate([
                'reconocimientos' => 'required',
                'terminos' => 'required',
            ]);
        }
    }
}
