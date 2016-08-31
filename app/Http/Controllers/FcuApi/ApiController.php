<?php

namespace App\Http\Controllers\FcuApi;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getStuInfo()
    {
        //TODO
        $json = [
            'UserInfo' => [],
        ];

        return response()->json($json);
    }
}
