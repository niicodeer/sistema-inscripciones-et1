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
            PreinscriptoSeeder::class,
            CursoSeeder::class,
            TutorSeeder::class,
            EstudianteSeeder::class,
            DatoEstudianteSeeder::class,
            InscripcionSeeder::class,
            PermissionSeeder::class
            //RolSeeder::class,
            //UserSeeder::class,
        ]);


        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
        ]);
        //$roleAdmin= Role::create(['name'=>'Admin']);
        $user->assignRole('Admin');

        $user2 = User::factory()->create([
            'name' => 'Secre',
            'email' => 'secretario@demo.com',
        ]);
        //$roleSecre= Role::create(['name'=>'Secretario']);
        $user2->assignRole('Secretario');

        $ajuste = Ajustes::factory()->create([
            'fecha_inscripcion' => '2024-09-06',
            'hora_inscripcion' => '00:00:00',
            'fecha_preinscripcion' => '2024-09-06',
            'hora_preinscripcion' => '00:00:00',
            'habilitar_inscripcion' => false,
            'habilitar_preinscripcion' => false
        ]);

    }
}
