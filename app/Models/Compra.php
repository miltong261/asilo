<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'user_id',
        'codigo',
        'fecha_registro',
        'fecha_compra',
        'documento',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
