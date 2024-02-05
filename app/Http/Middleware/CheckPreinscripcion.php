<?php

namespace App\Http\Middleware;

use Closure;

class CheckPreinscripcion
{
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario tiene una sesión activa y ha enviado el formulario
        if ($request->session()->has('preinscripcion_submitted')) {
            return $next($request);
        }

        // Si no se ha enviado el formulario, redirige a la página de inicio u otro lugar
        return redirect('/');
    }
}
