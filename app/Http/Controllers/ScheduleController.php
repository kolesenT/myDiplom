<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\CreateRequest;
use App\Models\Day;
use App\Models\Discipline;
use App\Models\NumLesson;
use App\Models\Schedule;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function list()
    {
        $schedule = Schedule::query()
            ->orderBy('day_id')->get();

        $days = Day::query()->orderBy('id')->get();
        $schoolClass = SchoolClass::find(1);

        return view('schedule.list', compact('schedule', 'days', 'schoolClass'));
    }

    public function createForm()
    {
        $days = Day::query()->orderBy('id')->get();
        $numLesson = NumLesson::query()->orderBy('num')->get();
        $discipline = Discipline::query()->orderBy('title')->get();
        return view('schedule.create', compact('days', 'numLesson', 'discipline'));
    }
    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        echo '<pre>';
           dd($data);
          echo '</pre>';
    }
}
