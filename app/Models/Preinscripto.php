<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscripto extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'apellido',
        'email',
        'telefono',
        'genero',
        'cuil',
        'fecha_nac',
    ];
}
