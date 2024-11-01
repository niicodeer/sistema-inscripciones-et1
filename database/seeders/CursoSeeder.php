<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Curso::factory()->create();
        $añoCurso = [1, 2, 3, 4, 5, 6];
        $añoDivision = [1, 2, 3, 4, 5, 6];

        $data = [];

        for ($i = 0; $i < count($añoCurso); $i++) {
            for ($j = 0; $j < count($añoDivision); $j++) {
                // Verificar si los índices existen antes de acceder a ellos
                $añoCursoValue = isset($añoCurso[$i]) ? $añoCurso[$i] : null;
                $añoDivisionValue = isset($añoDivision[$j]) ? $añoDivision[$j] : null;

                $data[] = [
                    'turno' => $j < 3 ? 'Mañana' : 'Tarde',
                    'año_curso' => $añoCursoValue,
                    'division' => $añoDivisionValue,
                    'cantidad_alumnos' => fake()->numberBetween(1, 22),
                    'cantidad_maxima' => fake()->numberBetween(20, 25),
                ];
            }
        }

        foreach ($data as $cursoData) {
            Curso::insert($cursoData);
        };
    }
}
