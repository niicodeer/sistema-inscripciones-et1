<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Rol::factory()->create();
        $roles = ['Admin', 'Secretario'];
        $data = [];
        foreach ($roles as $rol) {
            $data[] = [
                'name' => $rol,
                'guard_name' => 'web',
                'created_at'=> now(),
                'updated_at'=> now(),
            ];
        };


        foreach ($data as $rolData) {
            Role::insert($rolData);
        };
    }
}
