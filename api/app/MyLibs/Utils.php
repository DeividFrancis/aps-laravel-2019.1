<?php
/**
 * Created by PhpStorm.
 * User: pantufasuja
 * Date: 06/03/19
 * Time: 04:57
 */

namespace App\MyLibs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Utils
{
    public static function responseJson($status, $data){
        $res = [
            "status" => $status->type,
            "description" => $status->description
        ];
//        if(((count($data) > 1) == false) || (is_array($data[0]) == true)){
//            $data = $data[0];
//        }
        $res["data"] = $data;
        return response()->json($res, $status->code);
    }

    /**
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @return null
     * @throws \App\MyLibs\ErrorException
     */
    public static function validator(Request $request, Array $rules, Array $messages = []){

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $response = [];
            foreach ($validator->messages()->toArray() as $key => $value) {
                $obj = new \stdClass();
                $obj->name = $key;
                $obj->message = $value[0];

                array_push($response, $obj);
            }
//            var_dump($validator->messages());
            throw (new ErrorException(Status::ErrorValidate(), $response));
        }
        return null;
    }
}