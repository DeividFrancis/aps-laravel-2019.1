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

//        // Validate Pessoa
        if(!$pessoa) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }
//
//        // Validate Password
//        if (!Hash::check($credentials['password'], $company->password)) {
//            return response()->json([
//                'error' => 'Invalid credentials'
//            ], 401);
//        }
        $token = JWTAuth::fromUser($pessoa);

        $objToken = JWTAuth::setToken($token);
        return response()->json([
            "access_token"  => $token,
            "token_type" => 'baerer',
            "expires_in" => JWTAuth::decode($objToken->getToken())->get('exp')
        ]);
    }
}
