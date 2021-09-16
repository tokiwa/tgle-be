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

    public function postkeyword(Request $request)
    {
//        $data = $request->input('date');
//        return response()->json(['date' => $data]);

        //   下記でpostmanにてpostしたときのデータの取りだし
        //  {
        //  "keyword": ["慶応義塾大学", "東京大学","早稲田大学"],
        //  "course": "u3003",
        //  "userid": "user1",
        //  "lessonid":1
        //  }
        $data = $request->input();

        $course = $data['course'] ?? null;
        $userid = $data['userid'] ?? null;
        $lessonid = $data['lessonid'] ?? null;

        $count = count($data['keyword']);
        for ($i = 0; $i < $count; ++$i) {
            $keyword[$i] = $data['keyword'][$i];
        }
        return response()->json(['keyword' => $data['keyword']]);

    }

    public function receivedata(Request $request)
    {
        $data = $request->input();
        $dummy = 1;
        return response()->json(['result' => "OK"]);
    }

    public function test4a(Request $request)
    {
        $data = $request->input('date');
        return response()->json(['date' => $data]);
    }
}
