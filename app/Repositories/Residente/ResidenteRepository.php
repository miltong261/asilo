<?php

namespace App\Repositories\Residente;

use App\Models\Residente;
use App\Models\SignoVital;
use App\Repositories\BaseRepository;

class ResidenteRepository extends BaseRepository
{
    public function getModel()
    {
        return new Residente();
    }

    public function indexResidente()
    {
        return $this->getModel()
        ->join('municipios as municipio_origen', 'municipio_origen.id', '=', 'residentes.municipio_origen')
        ->join('municipios as municipio_dpi', 'municipio_dpi.id', '=', 'residentes.municipio_dpi')
        ->join('departamentos as departamento_origen', 'departamento_origen.id', '=', 'municipio_origen.departamento_id')
        ->join('departamentos as departamento_dpi', 'departamento_dpi.id', '=', 'municipio_dpi.departamento_id')
        ->select('residentes.*',
            'municipio_origen.nombre as municipio_origen_nombre',
            'municipio_dpi.nombre as municipio_dpi_nombre',
            'departamento_origen.nombre as departamento_origen_nombre',
            'departamento_dpi.nombre as departamento_dpi_nombre'
        )
        ->get();
    }

    public function residente($action, array $requestResidente, array $requestSignos, $id)
    {
        if ($action == 'guardar')
            return $this->guardar($requestResidente, $requestSignos);
        elseif ($action == 'actualizar')
            return $this->actualizar($requestResidente, $requestSignos, $id);
    }

    public function guardar(array $requestResidente, array $requestSignos)
    {
        $validarTiempo = $requestSignos['hora_registro'];

        if ($validarTiempo >= 0 && $validarTiempo < 12)
            $tiempo = 'Mañana';
        elseif ($validarTiempo >= 12 && $validarTiempo < 19)
            $tiempo = 'Tarde';
        else
            $tiempo = 'Noche';

        $signos = new SignoVital();

        $residente = $this->getModel()->create($requestResidente);

        $signos->create(['residente_id' => $residente->id] + $requestSignos + ['tiempo' => $tiempo]);

        if ($residente && $signos) return 'exitoso';
    }

    public function actualizar(array $requestResidente, array $requestSignos, $id)
    {
        $object = $this->getModel()->findOrFail($id);
        $signos = SignoVital::where('residente_id', $id);

        $object->update($requestResidente);
        $signos->update($requestSignos);

        if ($object && $signos) return 'exitoso';
    }
}
