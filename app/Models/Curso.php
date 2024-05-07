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
        'año_curso',
        'division',
        'cantidad_alumnos',
        'cantidad_maxima',
    ];

    public function inscripciones() : HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function getFullcursoAttribute()
    {
        return $this->añoCurso.'º '.$this->division.'º';
    }

}
