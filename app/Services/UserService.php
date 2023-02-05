<?php

namespace App\Services;

use App\Models\Code;
use App\Models\User;
use App\Models\User_info;

class UserService
{
    public function singIn(array $data, int $user_info_id): void
    {
        $user = new User($data);

        $user_info = User_info::find($user_info_id);

        $user->userInfo()->associate($user_info);
        $user->name = $user_info->surname . ' ' . $user_info->name;

        $user->save();

        $code = Code::find($user_info->code_id);
        $code->is_use = 1;
        $code->save();
    }
}
