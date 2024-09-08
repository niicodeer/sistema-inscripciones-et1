<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver usuario');
    }

    public function view(User $user, User $usuario): bool
    {
        return $user->hasPermissionTo('ver usuario');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear usuario');
    }

    public function update(User $user, User $usuario): bool
    {
        return $user->hasPermissionTo('editar usuario');
    }

    public function delete(User $user, User $usuario): bool
    {
        return $user->hasPermissionTo('borrar usuario');
    }

    public function restore(User $user, User $usuario): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $usuario): bool
    {
        return false;
    }
}
