<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            //RolSeeder::class,
            //UserSeeder::class,
        ]);


        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
        ]);
        $roleAdmin= Role::create(['name'=>'Admin']);
        $user->assignRole($roleAdmin);

        $user2 = User::factory()->create([
            'name' => 'Secre',
            'email' => 'secretario@demo.com',
        ]);
        $roleSecre= Role::create(['name'=>'Secretario']);
        $user2->assignRole($roleSecre);

    }
}
