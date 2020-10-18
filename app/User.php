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

    public function residentes()
    {
        return $this->hasMany('App\Models\Residente');
    }

    public function compras()
    {
        return $this->hasMany('App\Models\Compra');
    }

    public function salidas()
    {
        return $this->hasMany('App\Models\Salida');
    }

    public function donaciones()
    {
        return $this->hasMany('App\Models\Donacion');
    }

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }

    public function ajustes()
    {
        return $this->hasMany('App\Models\AjusteProducto');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Models\Movimiento');
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
