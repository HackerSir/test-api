<?php

namespace App\Http\Controllers\FcuApi;

use App\Client;
use App\Http\Controllers\Controller;
use App\Student;
use Request;

class ApiController extends Controller
{
    protected static $jsonOptions = JSON_PRESERVE_ZERO_FRACTION + JSON_UNESCAPED_UNICODE;

    public function getStuInfo()
    {
        $emptyJson = [
            'UserInfo' => [],
        ];
        //檢查Client
        $clientId = Request::get('client_id');
        if (!Client::where('client_id', $clientId)->count()) {
            //FIXME: 無效Client ID，還不知道會回傳什麼
            return response()->json($emptyJson);
        }
        //找出學生
        $stuId = Request::get('id');
        //NID為空
        if (array_key_exists('id', Request::all()) && $stuId == '') {
            return response()->json(['Message' => '發生錯誤。']);
        }
        //沒有填NID
        if (!$stuId) {
            return response()->json(['UserInfo' => ['']]);
        }
        //額外檢查（強制開頭大寫）
        $match = preg_match('/[A-Z].*/', $stuId);
        //找出學生實體
        $student = Student::find($stuId);
        //學生資料
        if ($match && $student) {
            //學生存在
            $studentData = [
                'status'    => '1',
                'message'   => '逢甲本學期在校生',
                'stu_id'    => $student->stu_id,
                'stu_name'  => $student->stu_name,
                'stu_class' => $student->stu_class,
                'unit_name' => $student->unit_name,
                'dept_name' => $student->dept_name,
                'in_year'   => $student->in_year,
                'stu_sex'   => $student->stu_sex,
            ];
        } else {
            //學生不存在（大小寫錯誤視為不存在）
            $studentData = [
                'status'    => '0',
                'message'   => '非逢甲本學期在校生',
                'stu_id'    => '',
                'stu_name'  => '',
                'stu_class' => '',
                'unit_name' => '',
                'dept_name' => '',
                'in_year'   => 0,
                'stu_sex'   => '',
            ];
        }

        $json = [
            'UserInfo' => [
                $studentData,
            ],
        ];

        return response()->json($json, 200, [], static::$jsonOptions);
    }

    public function auth()
    {
        //ClientID
        $clientId = Request::get('client_id');
        //ClientURL
        $clientUrl = Request::get('client_url');
        //暫存資料
        session([
            'client_id'  => $clientId,
            'client_url' => $clientUrl,
        ]);

        //導向OAuth登入頁面
        return redirect()->route('fcuapi.login.form');
    }

    public function showLoginForm()
    {
        //檢查ClientID
        $clientId = session('client_id');
        if (!Client::where('client_id', $clientId)->count()) {
            return view('fcuapi.oauth.error', ['message' => '應用程式代碼錯誤']);
        }

        return view('fcuapi.oauth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'nid'      => 'required|exists:students,stu_id',
            'password' => 'required|exists:students,password',
        ]);
        //檢查ClientURL
        $clientUrl = session('client_url');
        if (!filter_var($clientUrl, FILTER_VALIDATE_URL)) {
            return view('fcuapi.oauth.error', ['message' => '應用程式網址錯誤']);
        }

        //重新導向
        return redirect($clientUrl);
    }
}
