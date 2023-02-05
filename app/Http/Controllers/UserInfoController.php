<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfo\CreateRequest;
use App\Http\Requests\UserInfo\EditRequest;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User_info;
use App\Services\UserInfoService;

class UserInfoController extends Controller
{
    public function __construct(private UserInfoService $userInfoService)
    {
    }

    public function list()
    {
        $userInfo = User_info::query()
            ->orderBy('surname')
            ->orderBy('name')
            ->orderBy('patronymic')
            //если будет много пользователей рассмотреть метод lazy или что-то типо этого
            ->get();

        $roles = Role::all();
        return view('user.list', compact('userInfo', 'roles'));
    }

    public function createForm()
    {
        $roles = Role::all();
        $gender = Gender::all();
        return view('user.create', compact('roles', 'gender'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $this ->userInfoService->create($data);

        session()->flash('success', 'Success!');

        return redirect()->route('userInfo.list');
    }

    public function editForm(User_info $userInfo)
    {
        $gender = Gender::all();
        $roles = Role::all();
        return view('user.edit', compact('userInfo', 'gender', 'roles'));
    }

    public function edit(User_info $userInfo, EditRequest $request)
    {
        $data = $request->validated();

        $this ->userInfoService->edit($userInfo, $data);

        session()->flash('success', 'Success!');

        return redirect()->route('userInfo.list');
    }

    public function delete(User_info $userInfo)
    {
        $this ->userInfoService->delete($userInfo);

        session()->flash('success', 'Success!');

        return redirect()->route('userInfo.list');
    }

    public function show(User_info $userInfo)
    {
        return view('user.show', compact('userInfo'));
    }
}
