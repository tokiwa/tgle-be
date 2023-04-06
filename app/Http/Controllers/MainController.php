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
    public function mkgroup(Request $request)
    {
        function postJson($url, $data)
        {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            return $result;
        }

        $data = $request->input();
        $lessonid = $data['lessonid'];

        $kvdata = array();
        $studentid = array();

        $url = env('TGLE_MKGROUP_SERVER');

        $users = Keyword::where('lessonid', $lessonid)->where('role', "learner")->groupBy('userid')->get(['userid']);
        foreach ($users as $user) {
            $userid = $user->userid;
            $latest = Keyword::where('lessonid', $lessonid)->where('userid', $userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid', $lessonid)->where('userid', $userid)->where('sessionid', $latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword) {
                $keyword[] = $lastkeyword->keyword;
            }
            array_push($studentid, $userid);
            array_push($kvdata, $keyword);
        }

        $groupkw = array();
        $users = Keyword::where('lessonid', $lessonid)->where('role', "instructor")->groupBy('userid')->get(['userid']);
        foreach ($users as $user) {
            $userid = $user->userid;
            $latest = Keyword::where('lessonid', $lessonid)->where('userid', $userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid', $lessonid)->where('userid', $userid)->where('sessionid', $latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword) {
                $keyword[] = $lastkeyword->keyword;
            }
            array_push($groupkw, $keyword);
        }
        $groupKeyword = $groupkw[0];

        $jdata = array('student' => $kvdata, 'groupKeyword' => $groupKeyword);
        $data_json = json_encode($jdata, JSON_UNESCAPED_UNICODE);
        $url = env('TGLE_MKGROUP_SERVER'); // .envにて指定
        $res = postJson($url, $data_json);

        $arr = json_decode($res, true);
        $arr1 = json_decode($arr, true);

        foreach ($arr1 as $key => $value) {
            $i = (int)$key;
            $j = (int)$value;
            $group = new Group;
            $group->userid = $studentid[$i];
            $group->lessonid = $lessonid;
            $group->groupid = $groupKeyword[$j];
            $group->save();
        }

        return response()->json(['result' => $arr1]);
    }

    public function postkeyword(Request $request)
    {
        $data = $request->input();
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
        $lesson->status = 'active';
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
        $lessons = Lesson::where('academicyear', $academicyear)->where('label', $label)->where('status', $status)->get();

        return response()->json($lessons);
    }

    public function getkeyword(Request $request)
    {
        $data = $request->input();
        $lessonid = $data['lessonid'];
        $role = $data['role'];

        $user_keyword = array();

        $users = Keyword::where('lessonid', $lessonid)->where('role', $role)->groupBy('userid')->get(['userid']);

        foreach ($users as $user) {
            $userid = $user->userid;
            $latest = Keyword::where('lessonid', $lessonid)->where('userid', $userid)->latest()->first();
            $lastkeywords = Keyword::where('lessonid', $lessonid)->where('userid', $userid)->where('sessionid', $latest->sessionid)->get();
            $keyword = array();
            foreach ($lastkeywords as $lastkeyword) {
                $keyword[] = $lastkeyword->keyword;
            }
            $user_keyword[] = array("user" => $userid, "keyword" => $keyword);
        }

        return response()->json($user_keyword);
    }

    public function getgroup(Request $request)
    {
        $data = $request->input();
        $lessonid = $data['lessonid'];
        $role = $data['role'];
        $user_id = $data['user_id'];

        $user_group = array();
        $group_member = array();

        if ($role == 'instructor') {
            $users = Group::where('lessonid', $lessonid)->groupBy('userid')->get(['userid']);
            foreach ($users as $user) {
                $userid = $user->userid;
                $latest = Group::where('lessonid', $lessonid)->where('userid', $userid)->latest()->first();
                $user_group[] = array("group" => $latest->groupid, "user" => $userid);
            }
            return response()->json($user_group);
        }

        if ($role == 'learner') {
            $user = Group::where('lessonid', $lessonid)->where('userid', $user_id)->latest()->first();
            $users = Group::where('lessonid', $lessonid)->where('groupid', $user->groupid)->groupBy('userid')->get(['userid']);
            foreach ($users as $user) {
                $userid = $user->userid;
                $latest = Group::where('lessonid', $lessonid)->where('userid', $userid)->latest()->first();
                $group_member[] = array("group" => $latest->groupid, "user" => $userid);
            }
            return response()->json($group_member);
        }
    }

}
