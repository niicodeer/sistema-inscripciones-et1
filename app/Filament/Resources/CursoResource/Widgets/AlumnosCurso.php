<?php

namespace App\Filament\Resources\CursoResource\Widgets;

use App\Models\Curso;
use Filament\Widgets\ChartWidget;

class AlumnosCurso extends ChartWidget
{
    protected static ?string $heading = 'Alumnos por año curso';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $cursos = Curso::all(['año_curso', 'cantidad_alumnos']);
        $alumnosPorAño = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
        ];
        foreach ($cursos as $curso) {
            $añoCurso = $curso->año_curso;
            $cantidadAlumnos = $curso->cantidad_alumnos;
            $alumnosPorAño[$añoCurso] += $cantidadAlumnos;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de alumnos',
                    'data' => array_values($alumnosPorAño),
                    'backgroundColor' => '#B7250C',
                    'borderColor' => '#B7250C',
                ],
            ],
            'labels' => ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
