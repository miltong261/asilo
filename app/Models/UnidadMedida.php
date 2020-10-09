<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'unidad_medida';
    protected $fillable = ['codigo', 'nombre', 'medicamento', 'producto', 'estado'];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
