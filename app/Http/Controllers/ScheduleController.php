<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\CreateRequest;
use App\Models\Day;
use App\Models\Discipline;
use App\Models\NumLesson;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    public function __construct(private ScheduleService $scheduleService)
    {
    }

    public function list(SchoolClass $schoolClass)
    {
        $schedule = Schedule::query()
            ->where('class_id', $schoolClass->id)
            ->orderBy('day_id')->get();

        $days = Day::query()->orderBy('id')->get();

        return view('schedule.list', compact('schedule', 'days', 'schoolClass'));
    }

    public function createForm(SchoolClass $schoolClass)
    {
        $days = Day::query()->orderBy('id')->get();

        $numLesson = NumLesson::query()->orderBy('num')->get();
        $discipline = Discipline::query()->orderBy('title')->get();
        return view('schedule.create', compact('days', 'numLesson', 'discipline', 'schoolClass'));
    }

    public function create(CreateRequest $request)
    {
        $lessons = $request->get('lesson');
        $current_class = $request->get('schoolClass');
        $day = $request->get('days');

        $this ->scheduleService->create($lessons, $current_class, $day);

        session()->flash('success', 'Success!');
        return redirect()->route('schedule.list', ['schoolClass' => $current_class]);
    }
}
