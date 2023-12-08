<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DatoEstudiante>
 */
class DatoEstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $relacionConvivencia = ['padre','madre','abuelos','tios'];

        return [
            'medioTransporte' => fake() -> word(),
            'domicilio' => fake() -> address(),
            'obraSocial' => fake() -> word(),
            'lugarNacimiento' => fake() -> city(),
            'fechaIngreso' => fake() -> date(),
            'convivencia' => fake() -> randomElement($relacionConvivencia),
            'escuelaProviene' => fake() -> word(),

        ];
    }
}
