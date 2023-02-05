<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SingInRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function singInForm()
    {
        return view('sing-in');
    }

    public function singIn(SingInRequest $request)
    {
        $data = $request->validated();
        $user_info_id = $request->get('user_info');

        $this ->userService->singIn($data, $user_info_id);

        session()->flash('success', 'Success!');

        return redirect()->route('welcome');
    }
}
