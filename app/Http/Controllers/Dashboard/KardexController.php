<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kardex\KardexRequest;
use Illuminate\Http\Request;
use App\Repositories\Kardex\KardexRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KardexController extends Controller
{
    protected $kardexRepository;

    public function __construct(KardexRepository $kardexRepository)
    {
        $this->kardexRepository = $kardexRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return $this->kardexRepository->indexKardex();
    }

    public function store(KardexRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->kardexRepository->store($request->only(
                ['residente_id', 'producto_id', 'observacion'])
                + ['fecha_registro' => Carbon::now()]
                + ['hora' => Carbon::now()->isoFormat('H:mm:ss')]
                + ['user_id' => \Auth::user()->id]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente el kardex'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function kardex(Request $request)
    {
        return $this->kardexRepository->kardexTabla($request->id);
    }

    public function kardexFecha(Request $request)
    {
        return $this->kardexRepository->kardexTablaFecha($request->id, $request->fecha_buscar);
    }

    public function medicamentos()
    {
        return $this->kardexRepository->kardexMedicamentos();
    }
}
