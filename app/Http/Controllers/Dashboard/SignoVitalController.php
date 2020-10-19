<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SignoVital\SignoVitalRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SignoVitalController extends Controller
{
    protected $signosRepository;

    public function __construct(SignoVitalRepository $signosRepository)
    {
        $this->signosRepository = $signosRepository;
    }

    public function index()
    {
        return response()->json($this->signosRepository->indexSignos());
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->signosRepository->store($request->only(
                ['residente_id', 'respiraciones', 'presion', 'pulso', 'peso', 'temperatura', 'observacion']
                )
                + ['fecha_registro' => Carbon::now()]
                + ['hora_registro' => Carbon::now()->isoFormat('h:mm:ss')]
                + ['user_id' => \Auth::user()->id]
            );

            if ($guardar) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente la toma de signos vitales del residente'
                ]);
            } else {
                return $guardar;
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function signos(Request $request)
    {
        return $this->signosRepository->signosTabla($request->id);
    }

    public function signosFecha(Request $request)
    {
        return $this->signosRepository->signosTablaFecha($request->id, $request->fecha_buscar);
    }
}
