<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function getModel();

    public function index(array $fields)
    {
        return $this->getModel()->select($fields)->get();
    }

    public function store(array $request)
    {
        return $this->getModel()->create($request);
    }

    public function update(array $request, $id)
    {
        $object = $this->getModel()->findOrFail($id);
        $object->update($request);

        return $object;
    }

    public function listarCombo(array $fields, $orderField)
    {
        return $this->getModel()->select($fields)->orderBy($orderField, 'asc')->get();
    }

    public function storeWithMedicamentoProducto(array $request)
    {
        if ($request['medicamento'] == true || $request['producto'] == true)
            return $this->getModel()->create($request);
    }

    public function updateWithMedicamentoProducto(arrar $request, $id)
    {
        if ($request['medicamento'] == true || $request['producto'] == true){
            $object = $this->getModel()->findOrFail($id);
            $object->update($request);

            return $object;
        }
    }

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
