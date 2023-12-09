<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre',
        'apellido',
        'email',
        'cuil',
        'fecha_nac',
        'esAlumno',
    ];

    public function dato() : HasOne
    {
        return $this->hasOne(DatoEstudiante::class, 'id', 'dato_id');
    }

    public function inscripciones() : HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }
}
