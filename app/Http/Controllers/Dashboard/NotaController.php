<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Nota\NotaRequest;
use Illuminate\Http\Request;
use App\Repositories\Nota\NotaRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotaController extends Controller
{
    protected $notaRepository;

    public function __construct(NotaRepository $notaRepository)
    {
        $this->notaRepository = $notaRepository;
    }

    public function index()
    {
        return response()->json($this->notaRepository->indexNotas());
    }

    public function store(NotaRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->notaRepository->store($request->only(
                ['residente_id', 'nota'])
                + ['fecha_registro' => Carbon::now()]
                + ['hora' => Carbon::now()->isoFormat('h:mm:ss')]
                + ['user_id' => \Auth::user()->id]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó la nota correctamente'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function notas(Request $request)
    {
        return $this->notaRepository->notasTabla($request->id);
    }

    public function notasFecha(Request $request)
    {
        return $this->notaRepository->notasTablaFecha($request->id, $request->fecha_buscar);
    }
}
