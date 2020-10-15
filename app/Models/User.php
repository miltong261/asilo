<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'rol_id',
        'empleado_id',
        'fecha_registro',
        'usuario',
        'password',
        'estado'
    ];

    public function roles()
    {
        return $this->belongsTo('App\Models\Rol');
    }

    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado', 'empleado_id', 'id');
    }
}
