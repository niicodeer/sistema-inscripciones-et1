<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Preinscripto>
 */
class PreinscriptoFactory extends Factory
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
            'cuil' => fake()->numberBetween(10000000000, 20000000000),
            'genero' => fake()->randomElement(['Femenino', 'Masculino', 'Otro']),
            'telefono' => fake()->unique()->numerify('#############'),
            'fecha_nac' => fake()->date(),
            'condicion_preinscripcion' => fake()->randomElement(['alumno familiar', 'alumno general']),
        ];
    }
}
