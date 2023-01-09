<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function loginIn()
    {
        return view('welcome');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}
