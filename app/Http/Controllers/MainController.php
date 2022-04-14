<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Keyword;
use App\Lesson;
use App\Group;
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
        function postJson($url, $data){
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result=curl_exec($ch);
            return $result;
         //   echo 'RETURN:'.$result;
        }

        $data = $request->input();
        $lessonid = $data['lessonid'];

        $kvdata = array();
        $studentid = array();

        $users = Keyword::where('lessonid',$lessonid)->where('role',"learner")->groupBy('userid')->get(['userid']);
        foreach ($users as $user){
            $userid = $user->userid;
            $latest = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->where('sessionid',$latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword){
                $keyword[] = $lastkeyword->keyword;
            }
            array_push($studentid, $userid);
            array_push($kvdata, $keyword);
        }

        # Get Instructor Keyword = Group Keyword
        $groupkw = array();
        $users = Keyword::where('lessonid',$lessonid)->where('role',"instructor")->groupBy('userid')->get(['userid']);
        foreach ($users as $user){
            $userid = $user->userid;
            $latest = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid',$lessonid)->where('userid',$userid)->where('sessionid',$latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword){
                $keyword[] = $lastkeyword->keyword;
            }
            array_push($groupkw, $keyword);
        }
        # userid: Instructor ID
        $groupKeyword = $groupkw[0];

        $jdata =  array('student' => $kvdata, 'groupKeyword' => $groupKeyword);
        $data_json = json_encode($jdata, JSON_UNESCAPED_UNICODE);
        $url = 'http://192.168.1.105:9700/mkgroup';
        $res = postJson($url, $data_json);

        $arr = json_decode($res,true);
        $arr1 = json_decode($arr,true);

//        dd($studentid);  //dump & quit()

//  グループ化された結果をgroupsに書き込む
        foreach( $arr1 as $key => $value ){
            $i =  (int) $key;
            $j = (int) $value;
            $group = new Group;
            $group->userid = $studentid[$i];
            $group->lessonid = $lessonid;
//            $group->groupid = (string) $value;
            $group->groupid = $groupKeyword[$j];
            $group->save();
        }

//        return response()->json(['result' => 'Success']);
        // $studentid, groupKeywordを用いて、数字ではなく学生のUseridとgroup KeywordしてDBに書き込む。
        return response()->json(['result' => $arr1]);
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
            $keyword->role = $data['role'];
            $keyword->status = $data['status'];
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

//        $users = Keyword::where('lessonid',$lessonid)->groupBy('userid')->get(['userid']);
        $users = Keyword::where('lessonid',$lessonid)->where('role','learner')->groupBy('userid')->get(['userid']);
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

    public function getgroup(Request $request)
    {
        $data = $request->input();
        $lessonid = $data['lessonid'];
        $role = $data['role'];

        $user_group = array();

        $users = Group::where('lessonid',$lessonid)->groupBy('userid')->get(['userid']);
        foreach ($users as $user){
            $userid = $user->userid;
            $latest = Group::where('lessonid',$lessonid)->where('userid',$userid)->latest()->first();
            $user_group[] = array("group" => $latest->groupid,"user" => $userid);
        }
        return response()->json($user_group);
    }

}
