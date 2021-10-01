<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Keyword;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function postkeyword(Request $request)
    {
        $data = $request->input();
//        $course = $data['course'] ?? null;

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

        $lesson = new Lesson;
        $lesson->lessontitle = $data['lessontitle'];
        $lesson->label = $data['label'];
        $lesson->academicyear = $data['academicyear'];
        $lesson->save();

        return response()->json(['lessontitle' => $data['lessontitle']]);
    }

    public function getlesson(Request $request)
    {

        $lessons = Lesson::where('academicyear',2021)->pluck('lessontitle','id');

        return response()->json($lessons);
    }

}
