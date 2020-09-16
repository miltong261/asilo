<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $table = 'tipo_movimiento';
    protected $fillable = [
        'codigo',
        'nombre',
        'entrada',
        'salida',
        'estado'
    ];

    public function movimientos()
    {
        return $this->hasMany('App\Models\Movimiento');
    }
}
