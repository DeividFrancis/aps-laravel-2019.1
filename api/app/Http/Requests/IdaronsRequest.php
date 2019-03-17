<?php

namespace App\Http\Requests;

use App\Animal;
use Illuminate\Foundation\Http\FormRequest;

class IdaronsRequest extends FormRequest
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
        $macho = "m_";
        $femea = "f_";
        return [
            "descricao" => "required|string",
            "observacao" => "nullable|string",
            "cadastro" => "nullable|date",
            $macho.Animal::G_0006 => "required|integer",
            $femea.Animal::G_0006 => "required|integer",
            $macho.Animal::G_0612 => "required|integer",
            $femea.Animal::G_0612 => "required|integer",
            $macho.Animal::G_1224 => "required|integer",
            $femea.Animal::G_1224 => "required|integer",
            $macho.Animal::G_2436 => "required|integer",
            $femea.Animal::G_2436 => "required|integer",
            $macho.Animal::G_3699 => "required|integer",
            $femea.Animal::G_3699 => "required|integer",
        ];
    }
}
