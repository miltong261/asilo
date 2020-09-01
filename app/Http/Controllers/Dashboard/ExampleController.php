<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Example\ExampleRequest;
use Illuminate\Http\Request;

use App\Repositories\Example\ExampleRepository;

class ExampleController extends Controller
{
    protected $exampleRepository;

    public function __construct(ExampleRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function index()
    {
        return response()->json($this->exampleRepository->index(
            ['id', 'nombre', 'direccion']
        ));
    }

    public function store(ExampleRequest $request)
    {
        $example = $this->exampleRepository->store($request->only(
            ['nombre', 'direccion']
        ));

        return response()->json($example);
    }

    public function update(ExampleRequest $request)
    {
        $example = $this->exampleRepository->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion
        ], $request->id);

        return response()->json($example);
    }
}
