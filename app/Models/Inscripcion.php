<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscripcion extends Model
{
    use HasFactory;

    protected $fillable=[
        'aceptado',
        'fechaInscripcion',
    ];

    protected $table = "inscripciones";

    public function estudiante() : BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'id');
    }

    public function curso() : BelongsTo
    {
        return $this->belongsTo(Curso::class, 'estudiante_id', 'id');
    }

}
