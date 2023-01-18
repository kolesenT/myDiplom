<?php

namespace App\Http\Controllers;


use App\Http\Requests\Code\CodeRequest;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function singUpCodeForm()
    {
        return view('sing-up-code');
    }

    public function singUpCode(CodeRequest $request)
    {
        $code = $request -> validated();

    }
}
