<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use Hash;
class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoa = Pessoa::all();
        return response()->json($pessoa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pessoa = new Pessoa();
        $pessoa->fill($request->all());
        $pessoa->senha = Hash::make($request->senha);
        $pessoa->save();
        return response()->json($pessoa, 201);
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
