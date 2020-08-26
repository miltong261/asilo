<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
