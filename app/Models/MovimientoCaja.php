<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    protected $table = 'movimiento_caja';
    protected $fillable = ['codigo', 'nombre', 'entrada', 'salida', 'estado'];
}
