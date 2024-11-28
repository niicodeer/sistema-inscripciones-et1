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
            PermissionSeeder::class
        ]);
        if(env('APP_ENV') == 'production'){
            $admin = User::factory()->create([
                'name' => 'Administrador',
                'email' => 'admin@sia.com',
                'password' => bcrypt('Admin.24.sia'),
                'email_verified_at' => now(),
            ]);
            $admin->assignRole('Admin');
        }else{
            $this->call([
                PreinscriptoSeeder::class,
                CursoSeeder::class,
                TutorSeeder::class,
                EstudianteSeeder::class,
                DatoEstudianteSeeder::class,
                InscripcionSeeder::class,
            ]);
            $admin = User::factory()->create([
                'name' => 'Administrador',
                'email' => 'admin@demo.com',
                'password' => bcrypt('123456'),
            ]);
            $admin->assignRole('Admin');

            $user2 = User::factory()->create([
                'name' => 'Secre',
                'email' => 'secretario@demo.com',
                'password' => bcrypt('123456'),
            ]);
            $user2->assignRole('Secretario');
        }


        Ajustes::factory()->create([
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
