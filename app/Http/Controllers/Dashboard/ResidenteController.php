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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->residenteRepository->indexResidente());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResidenteRequest $request)
    {
            // $residente = $request->only([
            //     'municipio_origen', 'municipio_dpi', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'familia', 'direccion', 'telefono_familia', 'persona_referida', 'direccion_persona_referida', 'telefono_persona_referida', 'motivo', 'estado', 'historial', 'observacion'
            // ])
            // + ['codigo' => 'RESIDENTE-' . $this->residenteRepository->generateCode()]
            // + ['fecha_ingreso' => Carbon::now()];

            // $signos = $request->only([
            //     'pulso', 'temperatura', 'presion', 'peso'
            // ])
            // + ['fecha_registro' => Carbon::now()]
            // + ['hora_registro' => Carbon::now()->toTimeString()];

            // $guardar = $this->residenteRepository->residente('guardar', $residente, $signos, null);

            // if ($guardar == 'exitoso') {
            //     DB::commit();

            //     return response()->json([
            //         'status' => 'success',
            //         'message' => 'Se guardó correctamente al residente ' . $request->nombre . ' ' . $request->apellido
            //     ]);
            // }else
            //     return $guardar;

        try {
            DB::beginTransaction();

            $this->residenteRepository->store($request->only([
                'municipio_origen', 'municipio_dpi', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'familia', 'direccion', 'telefono_familia', 'persona_referida', 'direccion_persona_referida', 'telefono_persona_referida', 'motivo', 'estado', 'historial', 'observacion'])
                + ['codigo' => 'RESIDENTE-' . $this->residenteRepository->generateCode()]
                + ['fecha_ingreso' => Carbon::now()]
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResidenteUpdateRequest $request)
    {
        try {
            // $residente = $request->only([
            //     'municipio_origen', 'municipio_dpi', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'familia', 'direccion', 'telefono_familia', 'persona_referida', 'direccion_persona_referida', 'telefono_persona_referida', 'motivo', 'estado', 'historial', 'observacion'
            // ]);

            // $signos = $request->only([
            //     'pulso', 'temperatura', 'presion', 'peso'
            // ]);

            // $actualizar = $this->residenteRepository->residente('actualizar', $residente, $signos, $request->id);

            // if ($actualizar == 'exitoso') {
            //     DB::commit();

            //     return response()->json([
            //         'status' => 'success',
            //         'message' => 'Se actualizó correctamente al residente ' . $request->nombre . ' ' . $request->apellido
            //     ]);
            // }else
            //     return $actualizar;

            DB::beginTransaction();

            $this->residenteRepository->update($request->only([
                'nombre', 'apellido', 'fecha_nacimiento', 'familia', 'direccion', 'telefono_familia', 'persona_referida', 'direccion_persona_referida', 'telefono_persona_referida', 'motivo', 'estado', 'historial', 'observacion'
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

    public function pdf($id)
    {
        return $this->residenteRepository->pdfResidente($id);
    }
}
