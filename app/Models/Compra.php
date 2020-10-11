<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'codigo',
        'fecha_registro',
        'fecha_compra',
        'documento',
        'total'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
