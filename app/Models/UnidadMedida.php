<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
