<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table = 'salidas';
    protected $fillable = [
        'user_id',
        'empleado_id',
        'codigo',
        'fecha_registro',
        'fecha_salida'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
