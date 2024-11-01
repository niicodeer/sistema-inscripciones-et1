<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preinscripto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'nombre',
        'apellido',
        'email',
        'telefono',
        'genero',
        'cuil',
        'fecha_nac',
        'comprobante_preinscripcion',
        'condicion_preinscripcion'
    ];

    public function getNombreAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getApellidoAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getCondicionPreinscripcionAttribute($value)
    {
        return ucwords(strtolower($value));
    }

}
