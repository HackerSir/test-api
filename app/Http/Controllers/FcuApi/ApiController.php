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
            return response()->json($emptyJson);
        }
        //找出學生
        $stuId = Request::get('id');
        //額外檢查（強制開頭大寫）
        $match = preg_match("/[A-Z].*/", $stuId);
        $student = Student::find($stuId);
        if (!$match || !$student) {
            return response()->json($emptyJson);
        }

        $json = [
            'UserInfo' => [
                [
                    "stu_id"    => $student->stu_id,
                    "stu_name"  => $student->stu_name,
                    "stu_class" => $student->stu_class,
                    "unit_name" => $student->unit_name,
                    "dept_name" => $student->dept_name,
                    "in_year"   => $student->in_year,
                    "stu_sex"   => $student->stu_sex,
                ]
            ],
        ];

        return response()->json($json, 200, [], static::$jsonOptions);
    }
}
