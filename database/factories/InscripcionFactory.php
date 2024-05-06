<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscripcion>
 */
class InscripcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $relacionReconocimientos = ['familiar','meritos','otros'];
        return [
            'aceptado' => fake()->boolean(),
            'turno' => fake()->word(),
            'modalidad' => fake()->word(),
            'escuela_proviene' => fake()->word(),
            'condicion_alumno' => fake()->word(),
            'adeuda_materia' => fake()->boolean(),
            'nombre_materias' => fake()->word(),
            'reconocimientos' => json_encode([
                $this->faker->randomElement($relacionReconocimientos),
                $this->faker->randomElement($relacionReconocimientos),
            ]),
            'fecha_inscripcion' => fake()->date(),
            'estudiante_id' => fake()->numberBetween(1,30),
            'curso_id' => fake()->numberBetween(1,36),
        ];
    }
}
