<?php

namespace App\Policies;

use App\Models\PreInscripto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PreInscriptoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver preinscripto');

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PreInscripto $preInscripto): bool
    {
        return $user->hasPermissionTo('ver preinscripto');

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear preinscripto');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PreInscripto $preInscripto): bool
    {
        return $user->hasPermissionTo('editar preinscripto');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PreInscripto $preInscripto): bool
    {
        return $user->hasPermissionTo('borrar preinscripto');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PreInscripto $preInscripto): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PreInscripto $preInscripto): bool
    {
        //
    }
}
