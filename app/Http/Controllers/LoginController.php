<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SingInRequest;
use App\Models\User;
use App\Models\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function loginIn(SingInRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data))
        {
            $user = Auth::user();

            return match ($user->user_info->roles->name)
            {
                User_info::IS_ADMIN => view('admin'),
                User_info::IS_TEACHER => view('teacher.teacher'),
                User_info::IS_PARENT=> view('parent'),
                User_info::IS_PUPIL=> view('pupil'),
                default => view('home'),
            };
        }
    }
}
