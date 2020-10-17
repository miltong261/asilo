<?php

namespace App\Repositories\AjusteProducto;

use App\Models\Producto;
use App\Models\Inventario;
use App\Models\AjusteProducto;
use App\Repositories\BaseRepository;

class AjusteProductoRepository extends BaseRepository
{
    public function getModel()
    {
        return new AjusteProducto();
    }

    public function indexAjuste($type)
    {
        if ($type == 'producto') {
            return $this->getModel()
            ->join('users', 'users.id', '=', 'ajuste_producto.user_id')
            ->join('productos', 'productos.id', '=', 'ajuste_producto.producto_id')
            ->join('tipo_producto as categoria', 'categoria.id', '=', 'productos.tipo_producto_id')
            ->join('unidad_medida as unidad', 'unidad.id', '=', 'productos.unidad_medida_id')
            ->select('ajuste_producto.*',
            'users.usuario as nombre_usuario',
            'categoria.nombre as nombre_categoria',
            'unidad.nombre as nombre_unidad',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto'
            )
            ->where('productos.asignacion', '1')
            ->get();
        } elseif ($type == 'medicamento') {
            return $this->getModel()
            ->join('users', 'users.id', '=', 'ajuste_producto.user_id')
            ->join('productos', 'productos.id', '=', 'ajuste_producto.producto_id')
            ->join('tipo_producto as categoria', 'categoria.id', '=', 'productos.tipo_producto_id')
            ->join('unidad_medida as unidad', 'unidad.id', '=', 'productos.unidad_medida_id')
            ->select('ajuste_producto.*',
            'users.usuario as nombre_usuario',
            'categoria.nombre as nombre_categoria',
            'unidad.nombre as nombre_unidad',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto'
            )
            ->where('productos.asignacion', '0')
            ->get();
        }
    }

    public function ajuste(array $request)
    {
        if ($request['entrada'] == true && $request['salida'] == true) {
            return response()->json([
                'status' => 'error',
                'message' => 'Solo se permite marcar una opción'
            ]);
        } elseif ($request['entrada'] == false && $request['salida'] == false) {
            return response()->json([
                'status' => 'error',
                'message' => 'Debe marcar almenos una opción'
            ]);
        } else {
            $producto = Producto::findOrFail($request['producto_id']);
            $inventario = Inventario::findOrFail($request['producto_id']);

            if ($request['entrada'] == true) {
                $inventario->existencia += $request['cantidad'];

                $this->getModel()->create($request);
                $inventario->update(['existencia' => $inventario->existencia]);
                $producto->update(['fecha_ultimo_ajuste' => $request['fecha_registro']]);

                return 'exito';
            } elseif ($request['salida'] == true) {
                if ($inventario->existencia == 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'La existencia del producto es 0'
                    ]);
                } elseif ($inventario->existencia < $request['cantidad']) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'El producto cuenta con ' . $inventario->existencia . ' unidades, no se puede realizar la operación'
                    ]);
                } else {
                    $inventario->existencia -= $request['cantidad'];

                    $this->getModel()->create($request);
                    $inventario->update(['existencia' => $inventario->existencia]);
                    $producto->update(['fecha_ultimo_ajuste' => $request['fecha_registro']]);

                    return 'exito';
                }
            }
        }
    }
}

