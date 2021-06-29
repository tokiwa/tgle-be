<?php

namespace App\Http\Controllers;

class RespController extends Controller
{
    //
    public function index()
    {

    // 下記のいずれのプログラムもただしく実行される。

        $array = [
            'name' => '鈴木',
            'id' => 85
        ];
        return response()->json($array);

/*        return response()->json([
            'name' => '田中',
            'id' => 100
        ]);*/

/*        return response()->json(array(
            'name' => '佐藤',
            'id' => 50
        ));*/

    }
}
