<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class AnimaisRequest extends FormRequest
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
//            "unidade_id" => "required|integer",
//            "pessoa_id" => "required|integer",
            "mae_id" => "nullable|integer",
            "pai_id" => "nullable|integer",
            "descricao" => "nullable",
            "codigo" => "nullable|string|max:100",
            "nascimento" => "required|date",
            "obito" => "nullable|date",
            "observacao" => "nullable|max:255",
            "sexo" => "required|in:M,F",

        ];
    }
}
