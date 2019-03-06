<?php

namespace App\Http\Controllers;

use App\MyLibs\Status;
use App\MyLibs\Utils;
use Hamcrest\Util;
use Illuminate\Http\Request;
use App\Unidade;
use App\MyLibs\ModelUtils;
use App\MyLibs\ErrorException;
use Exception;

class UnidadesController extends Controller
{
    protected $rules = [
        "descricao" => "required|max:50"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Utils::responseJson(Status::SUCCESS(), Unidade::all());
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
        try{
            Utils::validator($request, $this->rules);
        }catch (ErrorException $e){
            return $e->getResponseJson();
        }
        $unidade = new Unidade();
        $unidade->fill($request->all());
        $unidade->save();
        return Utils::responseJson(Status::SUCCESS(), $unidade);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $unidade = ModelUtils::find(Unidade::class, $id);
            return Utils::responseJson(Status::SUCCESS(), $unidade);
        }catch (ErrorException $e){
            return $e->getResponseJson();
        }
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
        try{
            Utils::validator($request, $this->rules);
        }catch (ErrorException $e){
            return $e->getResponseJson();
        }
        try {
            $unidade = Unidade::findOrFail($id);
            $unidade->fill($request->all());
            $unidade->save();

            return response()->json($unidade);
        } catch (Exception $e) {
            return Utils::responseJson(Status::ERRO(), $e->getMessage());
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
        if (!$unidade) {
            return ModelUtils::findDB(Unidade::class, $id);
        }

        $unidade->delete();
        return Utils::responseJson(Status::SUCCESS(), "Deletado com sucesso");
    }
}
