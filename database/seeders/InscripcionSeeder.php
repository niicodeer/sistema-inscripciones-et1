<?php

namespace Database\Seeders;

use App\Models\Inscripcion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inscripcion::factory()->count(10)->create();
    }
}
