<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    $api->get('test', function () {
        return 'It is ok';
    });

});
Route::group(array('prefix' => 'v1'), function () {
    Route::get('/', function () {
        return response()->json(['message' => 'API Laravel', 'status' => 'Conectado']);
    });
    Route::post('auth/login', 'AuthController@authenticate');
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::resource('unidade', 'UnidadesController');
        Route::resource('pessoa', 'PessoasController');
        Route::resource('idaron', 'IdaronsController');
        Route::prefix('animal')->group(function () {
            Route::get('/', 'AnimaisController@index');
            Route::post('/', 'AnimaisController@store');
            Route::get('/{id}', 'AnimaisController@show');
            Route::put('/{id}', 'AnimaisController@update');
            Route::get('/idade', 'AnimaisController@grupoIdade');

        });
//        Route::resource('vacina', 'VacinasController');
        Route::prefix('vacina')->group(function () {
            Route::post("/", "VacinasController@store");
            Route::get("historico/{animal_id}", "VacinasController@historic");
            Route::get('tipo', "VacinasController@vacinaTipo")->name("vacina.tipo");

            //            Route::get("/teste", "VacinasController@historic");
        });
    });
});



