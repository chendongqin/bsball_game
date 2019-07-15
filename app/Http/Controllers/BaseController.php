<?php

namespace App\Http\Controllers;


class BaseController extends Controller
{
    protected function returnArrayJson(array $data){
        return response()->json($data);
    }

    protected function successJson(array $data = [],$msg ='成功'){
        return response()->json([
            'success' => true,
            'msg' => $msg,
            'data' => $data
        ], 200);
    }

    protected function errorJson($msg ='失败',$status = 300 ,array $data = []){
        return response()->json([
            'success' => false,
            'msg' => $msg,
            'data' => $data
        ], $status);
    }

}
