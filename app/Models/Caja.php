<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $fillable = [
        'nombre',
        'saldo'
    ];

    public function movimientos()
    {
        return $this->hasMany('App\Models\MovimientoCaja');
    }
}
