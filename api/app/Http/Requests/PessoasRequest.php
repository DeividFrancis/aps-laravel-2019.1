<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nomerazao" => "required|string|max:50",
            "apelidofantasia" => "nullable|string|max:20",
            "telefone1" => "nullable|integer|max:16",
            "telefone2" => "nullable|integer|max:16",
            "email1" => "nullable|email",
            "email2" => "nullable|email",
            "logradouro" => "nullable|string",
            "cpfCnpj" => "required|string",
            "ie" => "nullable|string",
            "rg" => "nullable|string",
//            "usuario" => "required|string",
//            "principal" => "required|string",
        ];
    }
}
