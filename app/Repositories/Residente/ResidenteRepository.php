<?php

namespace App\Repositories\Residente;

use App\Models\Residente;
use App\Models\SignoVital;
use App\Repositories\BaseRepository;

use Carbon\Carbon;

class ResidenteRepository extends BaseRepository
{
    public function getModel()
    {
        return new Residente();
    }

    public function indexResidente()
    {
        return $this->getModel()
        ->join('users', 'users.id', '=', 'residentes.user_id')
        ->join('municipios as municipio_origen', 'municipio_origen.id', '=', 'residentes.municipio_origen')
        ->join('municipios as municipio_dpi', 'municipio_dpi.id', '=', 'residentes.municipio_dpi')
        ->join('departamentos as departamento_origen', 'departamento_origen.id', '=', 'municipio_origen.departamento_id')
        ->join('departamentos as departamento_dpi', 'departamento_dpi.id', '=', 'municipio_dpi.departamento_id')
        ->select('residentes.*',
            'users.usuario as nombre_usuario',
            'users.rol_id',
            'municipio_origen.nombre as municipio_origen_nombre',
            'municipio_dpi.nombre as municipio_dpi_nombre',
            'municipio_origen.id as municipio_origen_id',
            'municipio_dpi.id as municipio_dpi_id',
            'departamento_origen.nombre as departamento_origen_nombre',
            'departamento_dpi.nombre as departamento_dpi_nombre',
            'departamento_origen.id as departamento_origen_id',
            'departamento_dpi.id as departamento_dpi_id',
        )
        ->orderBy('residentes.codigo', 'desc')
        ->get();
    }

    public function activo($type, $id)
    {
        $object = $this->getModel()->findOrFail($id);

        if ($type == 'activar')
            $object->activo = 1;
        elseif ( $type == 'desactivar')
            $object->activo = 0;
        elseif ($type == 'murio') {
            $object->activo = 0;
            $object->defuncion = 1;
        }

        return $object->save();
    }

    public function pdfResidente($id)
    {
        $data = $this->getModel()
        ->join('municipios as municipio_origen', 'municipio_origen.id', '=', 'residentes.municipio_origen')
        ->join('municipios as municipio_dpi', 'municipio_dpi.id', '=', 'residentes.municipio_dpi')
        ->join('departamentos as departamento_origen', 'departamento_origen.id', '=', 'municipio_origen.departamento_id')
        ->join('departamentos as departamento_dpi', 'departamento_dpi.id', '=', 'municipio_dpi.departamento_id')
        ->select('residentes.*',
            'municipio_origen.nombre as municipio_origen_nombre',
            'municipio_dpi.nombre as municipio_dpi_nombre',
            'municipio_origen.id as municipio_origen_id',
            'municipio_dpi.id as municipio_dpi_id',
            'departamento_origen.nombre as departamento_origen_nombre',
            'departamento_dpi.nombre as departamento_dpi_nombre',
            'departamento_origen.id as departamento_origen_id',
            'departamento_dpi.id as departamento_dpi_id',
        )
        ->where('residentes.id', $id)
        ->take(1)
        ->get();

        $fecha_actual = Carbon::now();
        $fecha_nacimiento = Carbon::parse($data[0]->fecha_nacimiento);
        $edad = $fecha_nacimiento->diffInYears($fecha_actual);

        $pdf = \PDF::loadView('pdf.formulario', compact('data', 'edad'));
        return $pdf->download('pdf-'.$data[0]->codigo.'.pdf');
    }
}
