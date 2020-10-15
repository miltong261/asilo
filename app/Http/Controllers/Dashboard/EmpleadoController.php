<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Empleado\EmpleadoRequest;
use Illuminate\Http\Request;
use App\Repositories\Empleado\EmpleadoRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function combobox()
    {
        return response()->json($this->empleadoRepository->comboboxEmpleado());
    }

    public function usuarios()
    {
        return response()->json($this->empleadoRepository->comboboxUsuario());
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
                'area_id', 'puesto_id', 'nombre', 'apellido', 'fecha_nacimiento', 'dpi', 'direccion', 'telefono'])
                + ['fecha_ingreso' => Carbon::now()]
                + ['codigo' => 'EMPLEADO- ' . $this->empleadoRepository->generateCode()]
            );

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
                ]),
                $request->id
            );

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

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->empleadoRepository->estado('activar', $request->id);

            if ($activar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se activó al empleado'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function desactivate(Request $request)
    {
        try {
            DB::beginTransaction();

            $desactivar = $this->empleadoRepository->estado('desactivar', $request->id);

            if ($desactivar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se desactivó al empleado ' .$request->nombre
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
