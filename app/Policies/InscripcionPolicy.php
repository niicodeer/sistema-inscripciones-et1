<?php

namespace App\Policies;

use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InscripcionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver estudiante');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Inscripcion $inscripcion): bool
    {
        return $user->hasPermissionTo('ver estudiante');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear estudiante');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Inscripcion $inscripcion): bool
    {
        return $user->hasPermissionTo('editar estudiante');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Inscripcion $inscripcion): bool
    {
        return $user->hasPermissionTo('borrar estudiante');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Inscripcion $inscripcion): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Inscripcion $inscripcion): bool
    {
        //
    }
}
