<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'estado_inscripcion',
        'fecha_inscripcion',
        'estudiante_id',
        'curso_id',
        'turno',
        'curso_inscripto',
        'modalidad',
        'escuela_proviene',
        'condicion_alumno',
        'adeuda_materias',
        'nombre_materias',
        'reconocimientos',
        'estudiante_id',
        'comprobante_inscripcion',
        'papeles_presentados'
    ];

    protected $casts = [
        'adeuda_materias' => 'boolean',
        'papeles_presentados' => 'boolean',
        'reconocimientos' => 'array',
        'fecha_inscripcion' => 'date',
    ];

    protected $table = "inscripciones";

    public function estudiante() : BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'id');
    }

    public function curso() : BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id');
    }



}
