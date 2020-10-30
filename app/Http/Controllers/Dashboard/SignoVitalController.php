<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Signo\SignoRequest;
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

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return $this->signosRepository->indexSignos();
    }

    public function store(SignoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->signosRepository->store($request->only(
                ['residente_id', 'respiraciones', 'presion', 'pulso', 'peso', 'temperatura', 'observacion']
                )
                + ['fecha_registro' => Carbon::now()]
                + ['hora_registro' => Carbon::now()->isoFormat('H:mm:ss')]
                + ['user_id' => \Auth::user()->id]
            );

            if ($guardar) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente los signos vitales del residente'
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

    public function graficos(Request $request)
    {
        return $this->signosRepository->estadistica($request->id);
    }
}
