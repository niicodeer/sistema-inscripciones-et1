<?php

namespace Database\Seeders;

use App\Models\Preinscripto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreinscriptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Preinscripto::factory()->count(30)->create();
    }
}
