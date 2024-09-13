<?php

namespace App\Http\Middleware;

use App\Models\Ajustes;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckHorarioHabilitado
{
    /**
     * Manejar la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ajustes = Ajustes::find(1);
            if (!$ajustes) {
                throw new Exception('No se encontraron los ajustes.');
            }

            $inicioPreinscripcion = $ajustes->inicio_fecha_preinscripcion . ' ' . $ajustes->inicio_hora_preinscripcion;
            $finPreinscripcion = $ajustes->fin_fecha_preinscripcion . ' ' . $ajustes->fin_hora_preinscripcion;
            $inicioInscripcion = $ajustes->inicio_fecha_inscripcion . ' ' . $ajustes->inicio_hora_inscripcion;
            $finInscripcion = $ajustes->fin_fecha_inscripcion . ' ' . $ajustes->fin_hora_inscripcion;
            $now = Carbon::now();

        $horaActual = Carbon::now();

        // Verificar si la hora actual está dentro del rango habilitado
        if ($horaActual->between($inicioPreinscripcion, $finPreinscripcion)) {
            // Si está dentro del rango, permitir continuar
            return $next($request);
        }

        // Si está fuera del rango, redirigir con una alerta         
        session()->flash('error', 'El proceso ha finalizado.');
        return redirect()->back();
    }
}