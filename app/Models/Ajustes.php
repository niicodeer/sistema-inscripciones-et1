<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajustes extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inscripcion',
        'hora_inscripcion',
        'fecha_preinscripcion',
        'hora_preinscripcion',
        'habilitar_inscripcion',
        'habilitar_preinscripcion'
    ];

}
