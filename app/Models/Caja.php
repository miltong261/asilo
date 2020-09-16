<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $fillable = [
        'movimiento_caja_id',
        'fecha_registro',
        'monto',
        'saldo',
        'observacion'
    ];

    public function movimientos()
    {
        return $this->hasMany('App\Models\MovimientoCaja');
    }
}
