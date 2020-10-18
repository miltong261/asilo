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

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
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

            $activar = $this->empleadoRepository->estadoEmpleado('activar', $request->id);

            if ($activar) {
                DB::commit();
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

            $desactivar = $this->empleadoRepository->estadoEmpleado('desactivar', $request->id);

            if ($desactivar) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
