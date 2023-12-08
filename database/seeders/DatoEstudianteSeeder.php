<?php

namespace Database\Seeders;

use App\Models\DatoEstudiante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatoEstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DatoEstudiante::factory()->count(10)->create();
    }
}
