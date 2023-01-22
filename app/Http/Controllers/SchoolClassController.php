<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClass\CreateRequest;
use App\Http\Requests\SchoolClass\EditRequest;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public  function list()
    {
        $schoolClass = SchoolClass::query()->orderBy('num')->orderBy('letter')->get();
        return view('schoolClass.list', compact('schoolClass'));
    }

    public function createForm()
    {
        return view('schoolClass.create');
    }

    public  function create(CreateRequest $request)
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

    public function delete(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        session()->flash('success', 'Success!');

        return redirect()->route('schClass.list');
    }
}
