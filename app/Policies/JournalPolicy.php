<?php

namespace App\Policies;

use App\Models\Journal;
use App\Models\User;
use App\Models\User_info;
use Illuminate\Auth\Access\HandlesAuthorization;

class JournalPolicy
{
    use HandlesAuthorization;

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

    public function delete(User $user, Journal $journal)
    {
        return $user->userInfo->role->name === User_info::IS_ADMIN;
    }
}
