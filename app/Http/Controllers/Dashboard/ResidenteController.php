<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Residente\ResidenteRequest;
use App\Http\Requests\Residente\ResidenteUpdateRequest;
use App\Models\Residente;
use Illuminate\Http\Request;
use App\Repositories\Residente\ResidenteRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResidenteController extends Controller
{
    protected $residenteRepository;

    public function __construct(ResidenteRepository $residenteRepository)
    {
        $this->residenteRepository = $residenteRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        $rol = \Auth::user()->rol_id;
        return response()->json(['query' => $this->residenteRepository->indexResidente(), 'rol' => $rol]);
    }

    public function store(ResidenteRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->residenteRepository->store($request->only([
                'municipio_origen', 'municipio_dpi', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'familia', 'direccion', 'telefono_familia', 'persona_referida', 'direccion_persona_referida', 'telefono_persona_referida', 'motivo', 'estado_fisico', 'estado_medico', 'estado_psicologico', 'observacion'])
                + ['codigo' => 'RESIDENTE-' . $this->residenteRepository->generateCode()]
                + ['fecha_ingreso' => Carbon::now()]
                + ['user_id' => \Auth::user()->id]
            );

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se guardó correctamente la ficha del residente ' . $request->nombre . ' ' .$request->apellido
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function update(ResidenteUpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->residenteRepository->update($request->only([
                'municipio_origen', 'municipio_dpi', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'familia', 'direccion', 'telefono_familia', 'persona_referida', 'direccion_persona_referida', 'telefono_persona_referida', 'motivo', 'estado_fisico', 'estado_medico', 'estado_psicologico', 'observacion'
            ]), $request->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizó correctamente la ficha del residente ' . $request->nombre . ' ' .$request->apellido
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->residenteRepository->activo('activar', $request->id);

            if ($activar)
                DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function desactivate(Request $request)
    {
        try {
            DB::beginTransaction();

            $desactivar = $this->residenteRepository->activo('desactivar', $request->id);

            if ($desactivar)
                DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function defuncion(Request $request)
    {
        try {
            DB::beginTransaction();

            $residente = $this->residenteRepository->activo('murio', $request->id);

            if ($residente)
                DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function pdf($id)
    {
        return $this->residenteRepository->pdfResidente($id);
    }
}
