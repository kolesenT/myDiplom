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
            $user = Auth::user();

            $role = Role::find($user->user_info->role_id);

            return match ($role->name)
            {
                User_info::IS_ADMIN =>  redirect()->route('admin'),
                User_info::IS_TEACHER => view('teacher.teacher'),
                User_info::IS_PARENT=> view('parent'),
                User_info::IS_PUPIL=> view('pupil'),
                default => view('home'),
            };
        }
        redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
