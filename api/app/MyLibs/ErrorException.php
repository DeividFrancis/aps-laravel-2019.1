<?php
/**
 * Created by PhpStorm.
 * User: pantufasuja
 * Date: 06/03/19
 * Time: 07:09
 */

namespace App\MyLibs;
use Exception;

class ErrorException extends Exception
{
    protected $responseJson;

    /**
     * ErrorException constructor.
     * @param Status $status
     * @param array $data
     */
    public function __construct(Status $status, $data)
    {
       $this->responseJson =  Utils::responseJson($status, $data);
    }

    public function getResponseJson()
    {
        return $this->responseJson;
    }
}