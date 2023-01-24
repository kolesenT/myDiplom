<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfo\CreateRequest;
use App\Http\Requests\UserInfo\EditRequest;
use App\Models\Code;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User_info;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function list()
    {
        $userInfo = User_info::query()
            ->orderBy('surname')
            ->orderBy('name')
            ->orderBy('patronymic')
            //если будет много пользователей рассмотреть метод lazy или что-то типо этого
            ->get();

        $roles = Role::all();
        return view('user.list', compact('userInfo','roles'));
    }

    public function createForm()
    {
        $roles = Role::all();
        $gender = Gender::all();
        return view('user.create', compact('roles', 'gender'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request ->validated();
//            echo '<pre>';
//            dd($data);
//            echo '</pre>';


        $userinfo = new User_info($data);

        $code = new Code();
        $code -> code_new = 1;
        $code ->save();

        $userinfo -> code_id = $code->id;
        $userinfo->gender_id = $data['gender'];
        $userinfo->role_id = $data['roles'];

        $userinfo -> save();

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

        $userInfo ->fill($data);
        $userInfo -> save();

        session()->flash('success', 'Success!');

        return redirect()->route('userInfo.list');
    }

    public function delete(User_info $userInfo)
    {
        $id = $userInfo->code->id;

        $code = Code::find($id);
        $code->delete();
        $userInfo->delete();

        session()->flash('success', 'Success!');

        return redirect()->route('userInfo.list');
    }

    public function show(User_info $userInfo)
    {
        return view('user.show', compact('userInfo'));
    }
}
