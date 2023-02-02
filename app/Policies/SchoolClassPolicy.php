<?php

namespace App\Policies;

use App\Models\SchoolClass;
use App\Models\User;
use App\Models\User_info;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolClassPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN || $user->userInfo->role->name === User_info::IS_TEACHER;
    }

    public function view(User $user)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN || $user->userInfo->role->name === User_info::IS_TEACHER;
    }

    public function create(User $user)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN || $user->userInfo->role->name === User_info::IS_TEACHER;
    }

    public function update(User $user)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN || $user->userInfo->role->name === User_info::IS_TEACHER;
    }

    public function delete(User $user, SchoolClass $schoolClass)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN;
    }

    public function forceDelete(User $user)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN;
    }
}
