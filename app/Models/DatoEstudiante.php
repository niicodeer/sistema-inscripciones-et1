<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatoEstudiante extends Model
{
    use HasFactory;

    protected $fillable=[
        'medio_transporte',
        'calle',
        'numeracion',
        'piso',
        'provincia',
        'ciudad',
        'localidad',
        'obra_social',
        'nombre_obra_social',
        'lugar_nacimiento',
        'fecha_ingreso',
        'convivencia',
        'escuela_proviene',
    ];

    public function estudiante(): BelongsTo
    {

        return $this->belongsTo(Estudiante::class);
    }
}
