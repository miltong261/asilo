<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function getModel();

    /* Método para listar */
    public function index(array $fields)
    {
        return $this->getModel()->select($fields)->get();
    }

    /* Método para guardar */
    public function store(array $request)
    {
        return $this->getModel()->create($request);
    }

    /* Método para actualizar */
    public function update(array $request, $id)
    {
        $object = $this->getModel()->findOrFail($id);
        $object->update($request);

        return $object;
    }

    /* Método para listar combobox */
    public function listarCombo(array $fields, $whereField, $orderField)
    {
        if ($whereField == null) {
            return $this->getModel()
            ->select($fields)
            ->orderBy($orderField, 'asc')
            ->get();

        }
        else {
            return $this->getModel()
            ->select($fields)
            ->where($whereField, '1')
            ->orderby($orderField, 'asc')
            ->get();
        }
    }

    /* Método para guardar (unidad de medida y tipo de producto) */
    public function storeWithMedicamentoProducto(array $request)
    {
        if ($request['medicamento'] == true || $request['producto'] == true)
            return $this->getModel()->create($request);
    }

    /* Método para actualizar (unidad de medida y tipo de producto) */
    public function updateWithMedicamentoProducto(arrar $request, $id)
    {
        if ($request['medicamento'] == true || $request['producto'] == true){
            $object = $this->getModel()->findOrFail($id);
            $object->update($request);

            return $object;
        }
    }

    /* Método para generar códigos */
    public function generateCode(){
        $count = $this->getModel()->count();

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
