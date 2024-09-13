<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PreinscripcionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3|max:20',
            'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3|max:20',
            'cuil' => 'required|regex:/^[0-9]{11}$/|unique:preinscriptos,cuil|min:11|max:11',
            'email' => 'required|email|max:100',
            'telefono' => 'required|regex:/^[0-9\s\-]+$/|min:8|max:15',
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
        ];
    }


    public function messages(): array
{
    return [
        'cuil.required' => 'El campo cuil es obligatorio',
            'cuil.unique' =>'El cuil ya existe.',
            'cuil.min'=>'El cuil debe tener 11 dígitos',
            'cuil.max'=>'El cuil debe tener 11 dígitos',
            'cuil.regex'=>'El cuil debe ser numérico',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'Nombre debe tener un mínimo de 3 caracteres',
            'nombre.max' => 'Nombre debe tener un máximo de 20 caracteres',
            'nombre.regex' => 'El campo Nombre no puede contener números',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.min' => 'Apellido debe tener un mínimo de 3 caracteres',
            'apellido.max' => 'Apellido debe tener un máximo de 20 caracteres',
            'apellido.regex' => 'El campo Apellido no puede contener números',
            'genero.required' => 'Debe seleccionar un género.',
            'genero.in' => 'El género seleccionado no es válido.',
            'fecha_nac.required' => 'El campo fecha de nacimiento es obligatorio.',
            'fecha_nac.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.max' => 'Teléfono debe tener un máximo de 15 caracteres',
            'telefono.min' => 'Teléfono debe tener un mínimo de 8 caracteres'
    ];
}
}


