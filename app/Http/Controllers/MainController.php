<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function write1(Request $request)
    {
        $json1 = $request->input('bangou');
        //echo 'a: '.$json1;
        $json2 = $request->input('name');
        //echo 'b: '.$json2;

//         $data1 = ['code' => '001', 'name' => 'eigyou'];
//         return $data1;

        return response()->json([
            'code' => '1',
            'name' => 'eigyou'
        ]);
    }
}
