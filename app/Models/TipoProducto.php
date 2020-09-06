<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipo_producto';
    protected $fillable = ['codigo', 'nombre', 'medicamento', 'producto', 'estado'];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
