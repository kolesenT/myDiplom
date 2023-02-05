<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClass\CreateRequest;
use App\Http\Requests\SchoolClass\EditRequest;
use App\Models\SchoolClass;
use App\Services\SchoolClassService;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function __construct(private SchoolClassService $schoolClassServices)
    {
    }

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

        $this -> schoolClassServices ->create($data);

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

        $this -> schoolClassServices ->edit($schoolClass, $data);

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
        $users = $this ->schoolClassServices->addUsersForm();

        return view('schoolClass.addUserForm', compact('schoolClass', 'users'));
    }

    public function addUsers(SchoolClass $schoolClass, Request $request)
    {
        $data = $request['users'];

        $this ->schoolClassServices->addUsers($schoolClass, $data);
        session()->flash('success', 'Success!');

        return redirect()->route('schClass.show', ['schoolClass' => $schoolClass->id]);
    }

    public function delete(SchoolClass $schoolClass)
    {
        $this ->schoolClassServices->delete($schoolClass);
        session()->flash('success', 'Success!');

        return redirect()->route('schClass.list');
    }
}
