<?php

namespace App\Filament\Resources\PreinscriptoResource\Widgets;

use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Preinscripto;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PreinscriptoOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Preinscriptos', Preinscripto::all()->count()),
            Stat::make('Total Inscripciones', Inscripcion::all()->count()),
            Stat::make('Inscripciones pendientes de revisión', Inscripcion::where('estado_inscripcion', 'pendiente')->count()),
            Stat::make('Total Alumnos', Estudiante::where('es_alumno', 1)->count()),
        ];
    }
}
