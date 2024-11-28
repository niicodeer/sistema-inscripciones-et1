<?php

namespace Database\Seeders;

use App\Models\Ajustes;
use Illuminate\Database\Seeder;

class AjustesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ajustes::create([
            'inicio_fecha_inscripcion' => '2024-09-01',
            'inicio_hora_inscripcion' => '00:00:00',
            'inicio_fecha_preinscripcion' => '2024-09-01',
            'inicio_hora_preinscripcion' => '00:00:00',
            'fin_fecha_inscripcion' => '2024-12-30',
            'fin_hora_inscripcion' => '00:00:00',
            'fin_fecha_preinscripcion' => '2024-12-30',
            'fin_hora_preinscripcion' => '00:00:00',
            'habilitar_inscripcion' => false,
            'habilitar_preinscripcion' => false
        ]);
    }
}
