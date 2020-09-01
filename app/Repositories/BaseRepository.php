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
}
