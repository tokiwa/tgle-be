<?php

namespace App\Http\Controllers;

class RespController extends Controller
{
    //
    public function index()
    {

        // 下記のいずれのプログラムもただしく実行される。

/*        $array = [
            'name' => '鈴木',
            'id' => 85
        ];
        return response()->json($array);*/

        /*        return response()->json([
                    'name' => '田中',
                    'id' => 100
                ]);*/

        /*        return response()->json(array(
                    'name' => '佐藤',
                    'id' => 50
                ));*/

// FE test3.htmlにて表示できる。
        $array = [
            ['name' => '佐藤太郎',
                'age' => 20,
                'sex' => '男',
            ],
            ['name' => '後藤太郎',
                'age' => 30,
                'sex' => '男',
            ],
            ['name' => '後藤太郎',
                'age' => 40,
                'sex' => '男',
            ],
        ];
        //連想配列をJSONに変換する。
        return response()->json($array);

    }
}
