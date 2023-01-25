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
//            $user = Auth::user();
//
//            $role = Role::find($user->userInfo->role_id);
//
//            return match ($role->name)
//            {
//                User_info::IS_ADMIN =>  redirect()->route('home'),
//                User_info::IS_TEACHER => view('teacher.teacher'),
//                User_info::IS_PARENT=> view('parent'),
//                User_info::IS_PUPIL=> view('pupil'),
//                default => view('welcome'),
//            };
        }
        return redirect()->route('welcome');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }
}
