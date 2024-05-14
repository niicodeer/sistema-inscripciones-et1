<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        $relacionConvivencia = ['padre', 'madre', 'abuelos', 'tios'];
        $relacionTransporte = ['moto', 'auto', 'bicicleta'];

        $data = [
            'calle' => fake()->address(),
            'numeracion' => fake()->numberBetween(0, 999),
            'provincia' => fake()->state(),
            'localidad' => fake()->city(),
            'ciudad' => fake()->country(),
            'obra_social' => fake()->boolean(),
            'nombre_obra_social' => fake()->word(),
            'lugar_nacimiento' => fake()->city(),
            'fecha_ingreso' => fake()->date(),
            'medio_transporte' => json_encode([
                $this->faker->randomElement($relacionTransporte),
                $this->faker->randomElement($relacionTransporte),
            ]),
            'convivencia' => json_encode([
                $this->faker->randomElement($relacionConvivencia),
                $this->faker->randomElement($relacionConvivencia),
            ]),
        ];

        return $data;
    }
}
