<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "CUIL" => fake()->numberBetween(1000000, 2000000),
            "nombre" => fake()->firstName(),
            "apellido" => fake()->lastName(),
            "email" => fake()->email(),
            "fecha_nac" => fake()->date(),
            "esAlumno" => fake ()-> boolean(),
            "idTutor"=>fake()->unique()->numberBetween(1,10)
        ];
    }
}
