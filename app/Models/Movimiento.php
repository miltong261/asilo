<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = [
        'user_id',
        'caja_id',
        'tipo_movimiento_id',
        'no_transaccion',
        'fecha_registro',
        'monto',
        'observacion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function caja()
    {
        return $this->belongsTo('App\Models\Caja');
    }

    public function tipoMovimiento()
    {
        return $this->belongsTo('App\Models\TipoMovimiento');
    }
}
