<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SingInRequest;
use App\Models\Code;
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
        $data = $request->validated();

        $user = new User($data);

        $user_info = User_info::find($request->get('user_info'));

        $user->userInfo()->associate($user_info);
        $user->name = $user_info->surname . ' ' . $user_info->name;

        $user->save();

        $code = Code::find($user_info->code_id);
        $code->is_use = 1;
        $code->save();

        session()->flash('success', 'Success!');

        return redirect()->route('welcome');
    }
}
