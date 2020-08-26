<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjusteProducto extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
