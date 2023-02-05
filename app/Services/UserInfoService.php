<?php

namespace App\Services;

use App\Models\Code;
use App\Models\User_info;

class UserInfoService
{
    public function create(array $data): void
    {
        $userinfo = new User_info($data);

        $code = new Code();
        $code->code_new = 1;
        $code->save();

        $userinfo->code_id = $code->id;
        $userinfo->gender_id = $data['gender'];
        $userinfo->role_id = $data['roles'];

        $userinfo->save();
    }

    public function edit(User_info $userInfo, array $data): void
    {
        $userInfo->fill($data);
        $userInfo->role()->associate($data['roles']);
        $userInfo->gender()->associate($data['gender']);
        $userInfo->save();
    }

    public function delete(User_info $userInfo)
    {
        $id = $userInfo->code->id;

        $code = Code::find($id);
        $code->delete();
        $userInfo->delete();
    }
}
