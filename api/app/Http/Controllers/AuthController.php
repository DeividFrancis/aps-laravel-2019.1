<?php

namespace App\Http\Controllers;

use App\MyLibs\Status;
use App\MyLibs\Utils;
use App\Pessoa;
use Illuminate\Http\Request;
use JWTAuth;
use Hash;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request){

        $credenciais = $request->only('cpfCnpj', 'senha');

        // Get user by email
        $pessoa = Pessoa::where('cpfCnpj', $credenciais['cpfCnpj'])->first();

        // Validate Pessoa
        if(!$pessoa) {
            return Utils::responseJson(Status::ERRO(), "Usúario ou senha invalidos");
        }
        // Validate Password
        if (!Hash::check($credenciais['senha'], $pessoa->senha)) {
            return Utils::responseJson(Status::ERRO(), "Usúario ou senha invalidos");
        }
        $customClains = ["uni_id" => $pessoa->unidade_id];
        $token = JWTAuth::fromUser($pessoa, $customClains);

        $objToken = JWTAuth::setToken($token);
        return response()->json([
            "access_token"  => $token,
            "token_type" => 'baerer',
            "expires_in" => JWTAuth::decode($objToken->getToken())->get('exp')
        ]);
    }
}
