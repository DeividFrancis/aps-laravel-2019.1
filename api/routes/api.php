<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(array('prefix' =>'v1'), function(){
   Route::get('/', function () {
      return response()->json(['message' => 'API Laravel', 'status' => 'Conectado']);
   });
    Route::post('auth/login', 'AuthController@authenticate');
    Route::group([ 'middleware' => ['jwt.auth']], function (){
       Route::resource('unidade', 'UnidadesController');
       Route::resource('pessoa', 'PessoasController');
       Route::resource('animal', 'AnimaisController');
   });
});



