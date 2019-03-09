<?php
/**
 * Created by PhpStorm.
 * User: pantufasuja
 * Date: 06/03/19
 * Time: 05:05
 */

namespace App\MyLibs;


class Status
{
    public $type;
    public $code;
    public $description;

    const ERROR = "Error";
    const SUCCESS = "Success";

    public function __construct($type, $code, $description)
    {
        $this->type = $type;
        $this->code = $code;
        $this->description = $description;
    }

    /**
     *
     */
    public static function ERRO()
    {
        return new Status(Status::ERROR, 400, "Ocorreu um erro durante o processo");
    }

    /**
     *
     */
    public static function SUCCESS()
    {
        return new Status(Status::SUCCESS, 200, "OK");
    }

    public static function NotFoud()
    {
        return new Status(Status::ERROR, 404, "Erro na busca");
    }

    public static function ErrorValidate()
    {
        return new Status(Status::ERROR, 400, "Erro de validação");
    }
    public static function Deleted()
    {
        return new Status(Status::SUCCESS, 204, "Erro de validação");
    }

    public static function Created()
    {
        return new Status(Status::SUCCESS, 201, "Criado com sucesso");
    }
}