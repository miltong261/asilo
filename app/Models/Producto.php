<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'unidad_medida_id',
        'tipo_producto_id',
        'codigo',
        'nombre',
        'existencia_inicial',
        'observacion',
        'asignacion',
        'fecha_registro',
        'fecha_vencimiento',
        'fecha_ultima_compra',
        'fecha_ultima_salida',
        'fecha_ultimo_ajuste'
    ];

    // Uno a muchos (inverso)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function unidadMedida()
    {
        return $this->belongsTo('App\Models\UnidadMedida');
    }

    public function tipoProducto()
    {
        return $this->belongsTo('App\Models\TipoProducto');
    }

    // Uno a muchos
    public function inventario()
    {
        return $this->hasMany('App\Models\Inventario');
    }

    public function ajusteProducto()
    {
        return $this->hasMany('App\Models\AjusteProducto');
    }

    // Muchos a muchos
    public function compras()
    {
        return $this->belongsToMany('App\Models\Compra');
    }

    public function salidas()
    {
        return $this->belongsToMany('App\Models\Salida');
    }

    public function donaciones()
    {
        return $this->belongsToMany('App\Models\Donacion');
    }
}
