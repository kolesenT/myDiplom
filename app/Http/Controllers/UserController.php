<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function singUpForm()
    {
        return view('sing-up');
    }

    public function singUpCodeForm()
    {
        return view('sing-up-code');
    }
}
