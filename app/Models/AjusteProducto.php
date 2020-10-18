<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjusteProducto extends Model
{
    protected $table = 'ajuste_producto';
    protected $fillable = [
        'user_id',
        'producto_id',
        'fecha_registro',
        'cantidad',
        'entrada',
        'salida',
        'observacion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
