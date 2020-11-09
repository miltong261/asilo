<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table = 'kardex';
    protected $fillable = [
        'user_id',
        'residente_id',
        'producto_id',
        'fecha_registro',
        'hora',
        'cantidad',
        'unidad_medida',
        'observacion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function residente()
    {
        return $this->belongsTo('App\Models\Residente');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
