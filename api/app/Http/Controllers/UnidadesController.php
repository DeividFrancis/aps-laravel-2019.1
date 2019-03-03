<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidade;
use Mockery\Exception;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Unidade::all());
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
        $unidade = new Unidade();
        $unidade->fill($request->all());
        $unidade->save();
        return response()->json($unidade, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = Unidade::find($id);
        if (!$unidade) {
            return response()->json([
                "message" => "Unidade não encontrada"
            ], 404);
        }

        return response()->json($unidade);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        try {
            $unidade = Unidade::findOrFail($id);
            $unidade->fill($request->all());
            $unidade->save();

            return response()->json($unidade);
        } catch (Exception $e) {
           return response()->json([
                "message" => "Erro ao durante opecação",
                "execption" => $e
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidade = Unidade::find($id);
        if(!$unidade){
            return response()->json([
                "message" => "Unidade não encontrada"
            ]);
        }

        $unidade->delete();
        return response()->json(["message" => "Deletado com sucesso"], 201);
    }
}
