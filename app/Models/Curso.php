<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable=[
        'turno',
        'añoCurso',
        'division',
        'cantidadAlumnos',
        'cantidadMaxima',
    ];

    public function inscripciones() : HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }

}
