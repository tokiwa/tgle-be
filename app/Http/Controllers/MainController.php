<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

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
        $data = $request->input();
        $course = $data['course'] ?? null;
        ////  $keywords = Keyword::where('user_id',$userid)->where('lesson_id',$lessonid)->pluck('keyword')->toArray();

        $unixtime = time(); //unixtimeをsessionidとする

        $count = count($data['keyword']);
        for ($i = 0; $i < $count; ++$i) {
            $keyword = new Keyword;
            $keyword->userid = $data['userid'];
            $keyword->lessonid = $data['lessonid'];
            $keyword->sessionid = $unixtime;
            $keyword->keyword = $data['keyword'][$i];
            $keyword->save();
        }
        return response()->json(['keyword' => $data['keyword']]);
    }

    public function postlesson(Request $request)
    {
        $data = $request->input();
        ////  $keywords = Keyword::where('user_id',$userid)->where('lesson_id',$lessonid)->pluck('keyword')->toArray();

        $unixtime = time(); //unixtimeをsessionidとする

        return response()->json(['title' => $data['title']]);
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
