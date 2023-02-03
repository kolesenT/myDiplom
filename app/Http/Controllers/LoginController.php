<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Models\Discipline;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\User_info;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function loginIn(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data))
        {
           return redirect()->route('home');
        }
        return redirect()->route('welcome');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }
}
