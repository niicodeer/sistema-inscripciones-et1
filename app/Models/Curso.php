<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory;
    use SoftDeletes;
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
        return $this->año_curso.'º '.$this->division.'º';
    }

}
