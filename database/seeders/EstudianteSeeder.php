<?php

namespace Database\Seeders;

use App\Models\Estudiante;

use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estudiante::factory()->count(30)->create();
    }
}
