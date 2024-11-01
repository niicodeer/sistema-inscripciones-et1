<?php

namespace App\Policies;

use App\Models\Ajustes;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AjustesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver ajustes');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ajustes $ajustes): bool
    {
        return $user->hasPermissionTo('ver ajustes');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear ajustes');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ajustes $ajustes): bool
    {
        return $user->hasPermissionTo('editar ajustes');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ajustes $ajustes): bool
    {
        return $user->hasPermissionTo('borrar ajustes');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ajustes $ajustes): bool
    {
        return $user->hasPermissionTo('restaurar ajustes');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ajustes $ajustes): bool
    {
        return $user->hasPermissionTo('forzar borrado ajustes');
    }
}
