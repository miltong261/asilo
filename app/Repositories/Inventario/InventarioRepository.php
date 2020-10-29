<?php

namespace App\Repositories\Inventario;

use App\Models\Inventario;
use App\Repositories\BaseRepository;

use Carbon\Carbon;

class InventarioRepository extends BaseRepository
{
    public function getModel()
    {
        return new Inventario();
    }

    public function inventarioProducto()
    {
        return $this->getModel()
        ->join('productos', 'productos.id', '=', 'inventario.producto_id')
        ->select('productos.id', 'productos.nombre')
        ->where('productos.asignacion', '1')
        ->where('productos.estado', '1')
        ->get();
    }

    public function inventarioMedicamento()
    {
        return $this->getModel()
        ->join('productos', 'productos.id', '=', 'inventario.producto_id')
        ->select('productos.id', 'productos.nombre')
        ->where('productos.asignacion', '0')
        ->where('productos.estado', '1')
        ->get();
    }

    public function inventarioSalidas($type)
    {
        if ($type == 'producto')
            $asignacion = 1;
        elseif ($type == 'medicamento')
            $asignacion = 0;

        return $this->getModel()
        ->join('productos', 'productos.id', '=', 'inventario.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->select('inventario.producto_id',
            'inventario.existencia',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto',
            'productos.fecha_vencimiento',
            'unidad_medida.nombre as nombre_unidad'
        )
        ->where('inventario.existencia', '>', 0)
        ->where('productos.estado', 1)
        ->where('productos.asignacion', $asignacion)
        ->where('productos.fecha_vencimiento', '>', Carbon::now()->toDateString())
        ->orWhere('productos.fecha_vencimiento', '=', null)
        ->get();
    }

    public function inventarioEntradas($type)
    {
        if ($type == 'producto')
            $asignacion = 1;
        elseif ($type == 'medicamento')
            $asignacion = 0;

        return $this->getModel()
        ->join('productos', 'productos.id', '=', 'inventario.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->select('inventario.producto_id',
            'inventario.existencia',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto',
            'productos.fecha_vencimiento',
            'unidad_medida.nombre as nombre_unidad'
        )
        ->where('productos.estado', 1)
        ->where('productos.asignacion', $asignacion)
        ->get();
    }
}
