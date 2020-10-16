<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'rol_id',
        'empleado_id',
        'fecha_registro',
        'usuario',
        'password',
        'primer_loring',
        'estado'
    ];

    public function roles()
    {
        return $this->belongsTo('App\Models\Rol');
    }

    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
