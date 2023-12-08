<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
