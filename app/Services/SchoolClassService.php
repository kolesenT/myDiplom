<?php

namespace App\Services;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\User_info;
use Illuminate\Support\Collection;

class SchoolClassService
{
    public function create(array $data): void
    {
        $schoolClass = new SchoolClass($data);
        $schoolClass->save();
    }

    public function edit(SchoolClass $schoolClass, array $data): void
    {
        $schoolClass->fill($data);
        $schoolClass->save();
    }

    public function addUsersForm(): Collection
    {
        $role = Role::query()
            ->where('name', User_info::IS_PUPIL)
            ->first();

        $users = User_info::query()
            ->with(['schoolClass', 'role'])
            ->where(function ($q) use ($role) {
                $q->where('role_id', $role->id);
            })
            ->orderBy('surname')
            ->orderBy('name')
            ->orderBy('patronymic')
            ->get();

        return $users;
    }

    public function addUsers(SchoolClass $schoolClass, array $data): void
    {
        $schoolClass->users()->attach($data);
    }

    public function delete(SchoolClass $schoolClass): void
    {
        $schoolClass->delete();
    }
}
