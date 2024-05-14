<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Preinscripto>
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
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'cuil' => fake()->numberBetween(1000000, 2000000),
            'telefono' => fake()->numberBetween(150000000, 159999999),
            'genero' => fake()->word(),
            'fecha_nac' => fake()->date(),
            'es_alumno' => fake()->boolean(),
            'tutor_id' => fake()->unique()->numberBetween(1, 30),
        ];
    }
}
