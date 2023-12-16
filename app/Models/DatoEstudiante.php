<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatoEstudiante extends Model
{
    use HasFactory;

    protected $fillable=[
        'medioTransporte',
        'domicilio',
        'obraSocial',
        'lugarNacimiento',
        'fechaIngreso',
        'convivencia',
        'escuelaProviene',
    ];

    public function estudiante(): BelongsTo
    {

        return $this->belongsTo(Estudiante::class);
    }
}
