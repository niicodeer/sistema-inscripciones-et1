<?php

namespace App\Filament\Resources\CursoResource\Widgets;

use App\Models\Curso;
use Filament\Widgets\ChartWidget;

class AlumnosTurno extends ChartWidget
{
    protected static ?string $heading = 'Alumnos por turno';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $cursos = Curso::all(['turno', 'cantidad_alumnos']);
        $alumnosPorTurno = [
            'Mañana' => 0,
            'Tarde' => 0,
        ];
        foreach ($cursos as $curso) {
            $turnoCurso = $curso->turno;
            $cantidadAlumnos = $curso->cantidad_alumnos;
            $alumnosPorTurno[$turnoCurso] += $cantidadAlumnos;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de alumnos',
                    'data' => array_values($alumnosPorTurno),
                    'backgroundColor' => '#7243A7',
                    'borderColor' => '#7243A7',
                ],
            ],
            'labels' => ['Mañana', 'Tarde'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
