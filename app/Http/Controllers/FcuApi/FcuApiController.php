<?php

namespace App\Http\Controllers\FcuApi;

use App\Http\Controllers\Controller;

class FcuApiController extends Controller
{
    public function index()
    {
        return view('fcuapi.index');
    }
}
