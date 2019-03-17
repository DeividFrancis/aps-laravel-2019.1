<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeRequest;
use App\Pessoa;
use App\Unidade;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * @property Unidade unidade
 * @property Pessoa pessoa
 */
class UnidadesController extends Controller
{

    public function __construct(Unidade $unidade)
    {
        $this->pessoa = \JWTAuth::parseToken()->authenticate();
        $this->unidade = $unidade;
    }

    public function index()
    {
//        dd($this->pessoa->unidade_id);
//        $data = $this->unidade->all()->where("id", "=", $this->pessoa->unidade_id);
        $data = $this->unidade->all();
        return response()->api($data);
    }

    public function store(UnidadeRequest $request)
    {
        $request->validate();
        $unidade = new Unidade();
        $unidade->fill($request->all());
        $unidade->save();
        return response()->api($unidade);
    }

    public function show($id)
    {
        $data = $this->unidade->find($id);
        return response()->api($data);
    }

    public function update(UnidadeRequest $request, $id)
    {
        $request->validate();
        $unidade = $this->unidade->findOrFail($id);
        $unidade->fill($request->all());
        $unidade->save();

        return response()->api($unidade);
    }

    public function destroy($id)
    {
    }
}
