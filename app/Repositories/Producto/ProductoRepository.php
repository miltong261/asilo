<?php

namespace App\Repositories\Producto;

use App\Models\Inventario;
use App\Models\UnidadMedida;
use App\Models\TipoProducto;
use App\Models\Producto;
use App\Repositories\BaseRepository;

class ProductoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Producto();
    }

    public function indexProducto($type)
    {
        $asignacion;

        if ($type == 'producto')
            $asignacion = 1;
        elseif ($type == 'medicamento')
            $asignacion = 0;

        return Inventario::join('productos', 'productos.id', '=', 'inventario.producto_id')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
            ->join('tipo_producto', 'tipo_producto.id', '=', 'productos.tipo_producto_id')
            ->select('inventario.*',
                'productos.*',
                'unidad_medida.nombre as unidad_nombre',
                'tipo_producto.nombre as categoria_nombre'
            )
            ->where('productos.asignacion', $asignacion)
            ->get();
    }

    /* Método para guardar producto y medicamento */
    public function storeProduct(array $request)
    {
        $inventario = new Inventario();

        $producto = $this->getModel()->create($request);
        $inventario->producto_id = $producto->id;
        $inventario->save();

        return 'exitoso';
    }

    /* Método para generar código de producto y medicamento */
    public function generateCodeProduct($type)
    {
        if ($type == 'producto') {
            $count = $this->getModel()
            ->where('asignacion', '1')
            ->count();
        } elseif ($type == 'medicamento') {
            $count = $this->getModel()
            ->where('asignacion', '0')
            ->count();
        }

        if ($count >= 1000 && $count < 10000)
            return $count+=1;
        elseif ($count >= 100 && $count < 1000)
            return '0' .$count+=1;
        elseif ($count >= 9 && $count < 100)
            return '00' .$count+=1;
        else
            return '000' .$count+=1;
    }
}
