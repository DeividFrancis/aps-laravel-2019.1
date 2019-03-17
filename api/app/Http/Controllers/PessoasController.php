<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoasRequest;
use Illuminate\Http\Request;
use App\Pessoa;
use Hash;

/**
 * @property Pessoa pessoa
 */
class PessoasController extends Controller
{
    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    public function index()
    {
        $pessoa = $this->pessoa->all();
        return response()->api($pessoa);
    }
    public function store(PessoasRequest $request)
    {
        $pessoaExist = Pessoa::where("cpfCnpj", "=", $request->input("cpfCnpj"))->first();
        if($pessoaExist != null){
            throw new \Exception("Pessoa com o cpf {$pessoaExist->cpfCnpj} já cadastrada.");
        }
        $request->validated();
        $pessoa = new Pessoa();
        $pessoa->fill($request->all());
        if($request->input('senha') != null ){
            $pessoa->usuario = 1;
            $pessoa->senha = Hash::make($request->input('senha'));
        }
        $pessoa->principal = 0;
        $pessoa->save();
        return response()->api($pessoa);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = Pessoa::find($id);
        if(!$pessoa){
            return response()->json([
                "error" => [
                    "descricao" => "Pessoa não encontrada"
                ]
            ]);
        }

        return response()->json($pessoa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        if (!$pessoa) {
            return response()->json([
                'error' => [
                    'descricao' => 'Pessoa não encontrada',
                    'message' => []
                ]
            ]);
        }

        $pessoa->fill($request->all());
        $pessoa->senha = Hash::make($request->senha);
        $pessoa->save();
        return response()->json($pessoa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = Pessoa::find($id);
        if (!$pessoa) {
            return response()->json([
                'error' => [
                    'descricao' => 'Pessoa não encontrada',
                    'message' => []
                ]
            ]);
        }
        $pessoa->delete();
        return response()->json(["descricao" => "Pessoa deletada com sucesso"]);
    }
}
