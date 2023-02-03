<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClass\CreateRequest;
use App\Http\Requests\SchoolClass\EditRequest;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\User_info;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function list()
    {
        $schoolClass = SchoolClass::query()->orderBy('num')->orderBy('letter')->get();
        return view('schoolClass.list', compact('schoolClass'));
    }

    public function createForm()
    {
        return view('schoolClass.create');
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $schoolClass = new SchoolClass($data);
        $schoolClass->save();

        session()->flash('success', 'Success!');

        return redirect()->route('schClass.list');
    }

    public function editForm(SchoolClass $schoolClass)
    {
        return view('schoolClass.edit', compact('schoolClass'));
    }

    public function edit(SchoolClass $schoolClass, EditRequest $request)
    {
        $data = $request->validated();
        $schoolClass->fill($data);
        $schoolClass->save();

        session()->flash('success', 'Success!');

        return redirect()->route('schClass.list');
    }

    public function show(SchoolClass $schoolClass)
    {
        $users = $schoolClass->users;

        return view('schoolClass.show', compact('schoolClass', 'users'));
    }

    public function addUsersForm(SchoolClass $schoolClass)
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

        return view('schoolClass.addUserForm', compact('schoolClass', 'users'));
    }

    public function addUsers(SchoolClass $schoolClass, Request $request)
    {
        $data = $request['users'];
        $schoolClass->users()->attach($data);

        session()->flash('success', 'Success!');

        return redirect()->route('schClass.show', ['schoolClass' => $schoolClass->id]);
    }

    public function delete(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        session()->flash('success', 'Success!');

        return redirect()->route('schClass.list');
    }
}
