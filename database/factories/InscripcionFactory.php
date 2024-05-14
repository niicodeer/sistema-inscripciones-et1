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
        $cursoInscripto = [
            'Primer año',
            'Segundo año',
            'Tercer año',
            'Cuarto año',
            'Quinto año',
            'Sexto año',
        ];
        return [
            'aceptado' => fake()->boolean(),
            'turno' => fake()->word(),
            'modalidad' => fake()->word(),
            'escuela_proviene' => fake()->word(),
            'condicion_alumno' => fake()->word(),
            'adeuda_materias' => fake()->boolean(),
            'nombre_materias' => fake()->word(),
            'reconocimientos' => json_encode([
                $this->faker->randomElement($relacionReconocimientos),
                $this->faker->randomElement($relacionReconocimientos),
            ]),
            'curso_inscripto'=> fake()->randomElement($cursoInscripto),
            'fecha_inscripcion' => fake()->date(),
            'estudiante_id' => fake()->numberBetween(1,30),
            'curso_id' => fake()->numberBetween(1,36),
        ];
    }
}
