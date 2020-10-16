<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Rol\RolRepository;

class RolController extends Controller
{
    protected $rolRepository;

    public function __construct(RolRepository $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function combobox()
    {
        return response()->json($this->rolRepository->comboboxRol());
    }
}
