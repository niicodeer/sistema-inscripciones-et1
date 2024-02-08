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

        $arrayOfPermissionNames = ['editar estudiante', 'borrar estudiante', 'crear estudiante', 'ver estudiante'];
    $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
        return ['name' => $permission, 'guard_name' => 'web'];
    });

    Permission::insert($permissions->toArray());
        

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Secretario'])
        ->givePermissionTo(['editar estudiante', 'ver estudiante']);
    }
}
