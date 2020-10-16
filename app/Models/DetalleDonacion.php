<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleDonacion extends Model
{
    protected $table = 'detalle_donacion';
    protected $fillable = [
        'donacion_id',
        'producto_id',
        'cantidad'
    ];
    public $timestamps = false;
}
