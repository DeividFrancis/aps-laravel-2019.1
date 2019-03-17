<?php
/**
 * Created by PhpStorm.
 * User: pantufasuja
 * Date: 06/03/19
 * Time: 04:32
 */

namespace App\MyLibs;
use Illuminate\Database\Eloquent\Model;

class ModelUtils
{
    /**
     * @param Model $model
     * @param Integer $id
     * @return mixed
     */
    public static function findDB($model, $id)
    {
        $res = $model::find($id);
        if (!$res) {
            return Utils::responseJson(Status::NotFoud(), (new \ReflectionClass($model))->getShortName()." não encontrada");
        }
        return Utils::responseJson(Status::SUCCESS(), $res);
    }

    /**
     * @param Model $class
     * @param $id
     * @param array $columns
     * @return mixed
     * @throws ErrorException
     */
    public static function find($class, $id, $columns = ['*'])
    {
        $res = $class::find($id, $columns);
        if (!$res) {
            throw (new ErrorException(Status::NotFoud(), ["message" => (new \ReflectionClass($class))->getShortName()." não encontrada"]));
        }
        return $res;
    }
}