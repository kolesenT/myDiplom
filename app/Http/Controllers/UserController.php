<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SingInRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function singInForm()
    {
        return view('sing-in');
    }

    public function singIn(SingInRequest $request)
    {
        $data = $request -> validated();

        $user = new User($data);

        $user_info = User_info::find(1);

        $user->user_info() -> associate($user_info);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        $user-> save();

        session()->flash('success', 'Success!');

        return redirect()->route('home');
    }

}
