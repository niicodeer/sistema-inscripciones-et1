<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudiante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'nombre',
        'apellido',
        'email',
        'cuil',
        'fecha_nac',
        'es_alumno',
        'telefono',
        'genero',
        'tutor_id'
    ];

    public function dato() : HasOne
    {
        return $this->hasOne(DatoEstudiante::class);
    }

    public function inscripciones() : HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function ultimaInscripcion() : HasOne
    {
        return $this->hasOne(Inscripcion::class)->latest('created_at');
    }

    public function tutor() : BelongsTo
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function getFullnameAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

}
