<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getdata(Request $request)
    {
        $json1 = $request->input('bangou');
        //echo 'a: '.$json1;
        $json2 = $request->input('name');
        //echo 'b: '.$json2;

//         $data1 = ['code' => '001', 'name' => 'eigyou'];
//         return $data1;

        return response()->json([
//            'code' => '1',
//            'name' => 'eigyou'
//      送信されたデータをそのまま返すように変更した。漢字も文字化けせずに送信できる、
            'code' => $json1,
            'name' => $json2
        ]);
    }

    public function postdata(Request $request)
    {
//        header("Access-Control-Allow-Origin: *");  //CORS
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With");

        $data = $request->input('name');

//        return $data;
        return response()->json(['name' => $data]);
    }


}
