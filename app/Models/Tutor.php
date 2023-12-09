<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable=[
        'cuit',
        'telefono',
        'nombre',
        'apellido',
        'ocupacion',
    ];

    protected $table = "tutores";

    public function estudiantes() : HasMany
    {
        return $this->hasMany(Estudiante::class);
    }
}
