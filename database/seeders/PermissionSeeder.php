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

        $arrayOfPermissionNames = [
            'crear estudiante', 'ver estudiante', 'editar estudiante', 'borrar estudiante', 'forzar borrado estudiante', 'restaurar estudiante',
            'crear preinscripto', 'ver preinscripto', 'editar preinscripto', 'borrar preinscripto', 'forzar borrado preinscripto', 'restaurar preinscripto',
            'crear inscripcion', 'ver inscripcion', 'editar inscripcion', 'borrar inscripcion', 'forzar borrado inscripcion', 'restaurar inscripcion',
            'crear tutor', 'ver tutor', 'editar tutor', 'borrar tutor', 'forzar borrado tutor', 'restaurar tutor',
            'crear curso', 'ver curso', 'editar curso', 'borrar curso', 'forzar borrado curso', 'restaurar curso',
            'crear usuario', 'ver usuario', 'editar usuario', 'borrar usuario', 'forzar borrado usuario', 'restaurar usuario',
            'crear ajustes', 'ver ajustes', 'editar ajustes', 'borrar ajustes', 'forzar borrado ajustes', 'restaurar ajustes',
        ];
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
