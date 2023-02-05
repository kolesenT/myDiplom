<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discipline\CreateRequest;
use App\Http\Requests\Discipline\EditRequest;
use App\Models\Discipline;
use App\Services\DisciplineService;

class DisciplineController extends Controller
{
    public function __construct(private DisciplineService $disciplineService)
    {
    }

    public function list()
    {
        $disciplines = Discipline::query()->orderBy('title')->get();
        return view('discipline.list', compact('disciplines'));
    }

    public function createForm()
    {
        return view('discipline.create');
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $this ->disciplineService ->create($data);

        session()->flash('success', 'Success!');

        return redirect()->route('discipline.list');
    }

    public function editForm(Discipline $discipline)
    {
        return view('discipline.edit', compact('discipline'));
    }

    public function edit(Discipline $discipline, EditRequest $request)
    {
        $data = $request->validated();

        $this ->disciplineService->edit($discipline, $data);

        session()->flash('success', 'Success!');

        return redirect()->route('discipline.list');
    }

    public function delete(Discipline $discipline)
    {
        $this->disciplineService->delete($discipline);
        session()->flash('success', 'Success!');

        return redirect()->route('discipline.list');
    }
}
