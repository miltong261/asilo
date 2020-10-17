<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->userRepository->indexUsuario());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->userRepository->storeUser($request->only([
            'rol_id', 'empleado_id'])
            + ['codigo' => $this->userRepository->generateCode()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        return $this->userRepository->updateUser($request->only([
            'usuario', 'password', 'password_confirm'])
            + ['codigo' => $this->userRepository->generateCode()],
            $request->id
        );
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->userRepository->estado('activar', $request->id);
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

            $desactivar = $this->userRepository->estado('desactivar', $request->id);
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
