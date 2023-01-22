<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discipline\CreateRequest;
use App\Http\Requests\Discipline\EditRequest;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function list()
    {
        $disciplines = Discipline::query()->orderBy('title')->get();
        return view('discipline.list', compact('disciplines'));
    }

    public  function createForm()
    {
        return view('discipline.create');
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
//           echo '<pre>';
//           dd($data);
//            echo '</pre>';
        $discipline = new Discipline($data);
        $discipline->save();

        session()->flash('success', 'Success!');

        return redirect()->route('discipline.list');
    }

    public  function  editForm(Discipline $discipline)
    {
        return view('discipline.edit', compact('discipline'));
    }

    public function  edit(Discipline $discipline, EditRequest $request)
    {
        $data = $request ->validated();
        $discipline -> fill($data);
        $discipline->save();

        session()->flash('success', 'Success!');

        return redirect()->route('discipline.list');
    }

    public  function delete(Discipline $discipline)
    {
        $discipline->delete();

        session()->flash('success', 'Success!');

        return redirect()->route('discipline.list');
    }
}
