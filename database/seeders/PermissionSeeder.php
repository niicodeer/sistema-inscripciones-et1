<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'editar estudiante']);
        Permission::create(['name' => 'borrar estudiante']);
        Permission::create(['name' => 'crear estudiante']);
        Permission::create(['name' => 'ver estudiante']);
        

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Secretario'])
        ->givePermissionTo(['editar estudiante', 'ver estudiante']);
    }
}
