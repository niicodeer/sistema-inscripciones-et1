<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Rol extends Model
{
    use HasFactory;
    use HasRoles;

    protected $table = 'roles';

    public function user(){

        return $this->hasMany(User::class);

        

    }
}
