<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Empleado\EmpleadoRequest;
use App\Repositories\Empleado\EmpleadoRepository;

use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    protected $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepository)
    {
        $this->empleadoRepository = $empleadoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->empleadoRepository->indexEmpleado());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->empleadoRepository->store($request->only([
                'puesto_id', 'fecha_ingreso', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'direccion', 'telefono'
            ]) + ['codigo' => $this->empleadoRepository->generateCode()]);

            if ($guardar) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente al empleado ' . $request->nombre
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocurrio un error'
                ]);
            }

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
    public function update(EmpleadoRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->empleadoRepository->update($request->only([
                'puesto_id', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'direccion', 'telefono'
            ]), $request->id);

            return $actualizar;

            if ($actualizar) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente al empleado ' . $request->nombre
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocurrio un error'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
