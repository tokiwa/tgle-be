<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Keyword;
use App\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function posttest(Request $request)
    {
        $data = $request->input();
//        $course = $data['course'] ?? null;

        return response()->json(['keyword' => 'Success']);
    }

    public function mkgroup(Request $request)
    {
        $data = $request->input();
        $lessonid = $data['lessonid'];

        $user_keyword = array();
        $kvdata = array();

        $users = Keyword::where('lessonid',$lessonid)->groupBy('userid')->get(['userid']);
        foreach ($users as $user){
            $userid = $user->userid;
            $latest = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->where('sessionid',$latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword){
                $keyword[] = $lastkeyword->keyword;
            }
            $user_keyword[] = array("user" => $userid,"keyword" => $keyword);
            //$kvdata[] = array($keyword);
        }
        $data_json = json_encode($user_keyword);
        return response()->json(['keyword' => 'Success']);
    }

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
        $lesson->status = 'prep';
        $lesson->academicyear = $data['academicyear'];
        $lesson->save();

        return response()->json(['lessontitle' => $data['lessontitle']]);
    }

    public function getlesson(Request $request)
    {
        $data = $request->input();

        $academicyear = $data['academicyear'];
        $label = $data['label'];
        $status = $data['status'];


//        $label = 'u3003';
//        $lessons = Lesson::where('academicyear',2021)->pluck('lessontitle','id');
        $lessons = Lesson::where('academicyear',$academicyear)->where('label',$label)->where('status',$status)->get();

        return response()->json($lessons);
    }

    public function getkeyword(Request $request)
    {
        $data = $request->input();
        $lessonid = $data['lessonid'];

        $user_keyword = array();

        $users = Keyword::where('lessonid',$lessonid)->groupBy('userid')->get(['userid']);
        foreach ($users as $user){
            $userid = $user->userid;
            $latest = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->where('sessionid',$latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword){
                $keyword[] = $lastkeyword->keyword;
            }
        $user_keyword[] = array("user" => $userid,"keyword" => $keyword);
        }

        return response()->json($user_keyword);
    }

}
