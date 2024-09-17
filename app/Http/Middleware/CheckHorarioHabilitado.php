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
    public function handle(Request $request, Closure $next, $tipo)
    {
        $ajustes = Ajustes::first();
        if (!$ajustes) {
            throw new Exception('No se encontraron los ajustes.');
        }

        $horaActual = Carbon::now();

        if ($tipo === 'preinscripcion') {
            $inicioPreinscripcion = $ajustes->inicio_fecha_preinscripcion . ' ' . $ajustes->inicio_hora_preinscripcion;
            $finPreinscripcion = $ajustes->fin_fecha_preinscripcion . ' ' . $ajustes->fin_hora_preinscripcion;

            if ($ajustes->habilitar_preinscripcion && $horaActual->between($inicioPreinscripcion, $finPreinscripcion)) {
                return $next($request);
            }
        } elseif($tipo === 'inscripcion'){
            $inicioInscripcion = $ajustes->inicio_fecha_inscripcion . ' ' . $ajustes->inicio_hora_inscripcion;
            $finInscripcion = $ajustes->fin_fecha_inscripcion . ' ' . $ajustes->fin_hora_inscripcion;

            if ($ajustes->habilitar_inscripcion && $horaActual->between($inicioInscripcion, $finInscripcion)) {
                return $next($request);
            }
        }

        return redirect()->back()->with('error', 'El proceso ha finalizado o ya no se encuentra habilitado.');
    }
}
