<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User_info;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function list()
    {
        $users = User_info::query()
            ->orderBy('surname')
            ->orderBy('name')
            ->orderBy('patronymic')
            //если будет много пользователей рассмотреть метод lazy или что-то типо этого
            ->get();
            echo '<pre>';
             dd($users->fullname);
            echo '</pre>';
        $roles = Role::all();
        return view('user.list', compact('users','roles'));
    }
}
