<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = [
        'tipo_movimiento_id',
        'no_transaccion',
        'monto',
        'observacion'
    ];

    public function tipoMovimiento()
    {
        return $this->belongsTo('App\Models\TipoMovimiento');
    }
}
