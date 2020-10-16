<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleSalida extends Model
{
    protected $table = 'detalle_salida';
    protected $fillable = [
        'salida_id',
        'producto_id',
        'cantidad'
    ];
    public $timestamps = false;
}
