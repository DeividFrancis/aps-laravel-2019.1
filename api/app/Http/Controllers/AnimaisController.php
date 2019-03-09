<?php

namespace App\Http\Controllers;

use App\Animal;
use App\MyLibs\Status;
use App\MyLibs\Utils;
use Illuminate\Http\Request;
//use Tymon\JWTAuth\JWTAuth;
use JWTAuth;

class AnimaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $token = JWTAuth::parseToken();
        $uniId = \Auth::user()->unidade_id;
        $animais = Animal::where("unidade_id", $uniId);
        $animais = !$animais ? $animais : [];
//        var_dump($token);
        return Utils::responseJson(Status::SUCCESS(), $animais);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pessoa = \Auth::user();
        $uniId = $pessoa->unidade_id;
        $pesId = $pessoa->id;

        $animal = new Animal();
        $animal->fill($request->all());
        $animal->unidade_id = $uniId;
        $animal->pessoa_id = $pesId;
        $animal->save();
        return Utils::responseJson(Status::Created(), $animal);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
