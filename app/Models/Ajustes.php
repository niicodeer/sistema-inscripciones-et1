<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajustes extends Model
{
    use HasFactory;

    protected $fillable = [
        'inicio_fecha_inscripcion',
        'inicio_hora_inscripcion',
        'inicio_fecha_preinscripcion',
        'inicio_hora_preinscripcion',
        'fin_fecha_inscripcion',
        'fin_hora_inscripcion',
        'fin_fecha_preinscripcion',
        'fin_hora_preinscripcion',
        'habilitar_inscripcion',
        'habilitar_preinscripcion'
    ];

}
