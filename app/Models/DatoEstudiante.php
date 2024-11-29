<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatoEstudiante extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'medio_transporte',
        'calle',
        'numeracion',
        'piso',
        'departamento',
        'localidad',
        'barrio',
        'obra_social',
        'nombre_obra_social',
        'lugar_nacimiento',
        'fecha_ingreso',
        'convivencia',
        'estudiante_id',
    ];

    protected $casts = [
        'medio_transporte' => 'array',
        'convivencia' => 'array',
        'obra_social' => 'boolean',
        'fecha_ingreso' => 'date',
    ];

    public function estudiante(): BelongsTo
    {

        return $this->belongsTo(Estudiante::class);
    }
}
