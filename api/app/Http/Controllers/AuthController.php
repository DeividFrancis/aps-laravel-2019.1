<?php

namespace App\Http\Controllers;

use App\Pessoa;
use Illuminate\Http\Request;
use JWTAuth;
use Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request){

        $credenciais = $request->only('cpfCnpj', 'senha');

        // Get user by email
        $pessoa = Pessoa::where('cpfCnpj', $credenciais['cpfCnpj'])->first();

        // Validate Pessoa
        if(!$pessoa) {
            return response()->json([
                'error' => 'Usúario ou senha invalidos'
            ], 403);
        }
        // Validate Password
        if (!Hash::check($credenciais['senha'], $pessoa->senha)) {
            return response()->json([
                'error' => 'Usúario ou senha invalidos'
            ], 403);
        }
        $token = JWTAuth::fromUser($pessoa);

        $objToken = JWTAuth::setToken($token);
        return response()->json([
            "access_token"  => $token,
            "token_type" => 'baerer',
            "expires_in" => JWTAuth::decode($objToken->getToken())->get('exp')
        ]);
    }
}
