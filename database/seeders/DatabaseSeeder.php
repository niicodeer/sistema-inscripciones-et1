<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ajustes;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            AjustesSeeder::class,
            UserSeeder::class,
        ]);
        if (env('APP_ENV') == 'production') {
            $this->call([
               // UserSeeder::class,
                PreinscriptoSeeder::class,
                CursoSeeder::class,
                TutorSeeder::class,
                EstudianteSeeder::class,
                DatoEstudianteSeeder::class,
                InscripcionSeeder::class,
                PermissionSeeder::class,
                AjustesSeeder::class,
            ]);
        } else {
            $this->call([
                PreinscriptoSeeder::class,
                CursoSeeder::class,
                TutorSeeder::class,
                EstudianteSeeder::class,
                DatoEstudianteSeeder::class,
                InscripcionSeeder::class,
            ]);
        }
    }
}
