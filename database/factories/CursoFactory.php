<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'turno' => $this->faker->randomElement(['mañana', 'tarde']),
            'añoCurso' => $this->faker->numberBetween(1, 6),
            'division' => $this->faker->numberBetween(1, 4),
            'cantidadAlumnos' => $this->faker->numberBetween(1, 22),
            'cantidadMaxima' => $this->faker->numberBetween(20, 22),
        ];
    }
}
