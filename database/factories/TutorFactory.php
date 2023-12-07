<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tutor>
 */
class TutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cuil' => fake()->numberBetween(1000000, 2000000),
            'telefono' => fake()->phoneNumber(),
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'ocupacion' => fake()->word(),
        ];
    }
}