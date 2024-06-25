<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscripcion extends Model
{
    use HasFactory;

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
        'comprobante_inscripcion'
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
