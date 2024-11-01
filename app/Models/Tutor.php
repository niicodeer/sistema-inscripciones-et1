<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'cuil',
        'telefono',
        'nombre',
        'apellido',
        'ocupacion',
        'email',
        'parentezco'
    ];

    protected $table = "tutores";

    public function estudiantes() : HasMany
    {
        return $this->hasMany(Estudiante::class);
    }
}
