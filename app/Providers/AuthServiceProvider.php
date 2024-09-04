<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Preinscripto;
use App\Models\Tutor;
use App\Models\User;
use App\Policies\CursoPolicy;
use App\Policies\EstudiantePolicy;
use App\Policies\InscripcionPolicy;
use App\Policies\PreInscriptoPolicy;
use App\Policies\TutorPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Estudiante::class => EstudiantePolicy::class,
        Preinscripto::class => PreInscriptoPolicy::class,
        Inscripcion::class => InscripcionPolicy::class,
        Tutor::class => TutorPolicy::class,
        Curso::class => CursoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
