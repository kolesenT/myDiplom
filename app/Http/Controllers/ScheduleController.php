<?php

namespace App\Http\Controllers;

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
            ->with(['days', 'class', 'discipline', 'numLesson'])
            ->where('class_id', 1)
            ->orderBy('days_id')->get();

        $days = Day::query()->orderBy('id')->get();
        $schoolClass = SchoolClass::find(2);
//        echo '<pre>';
//           dd($schedule);
//           echo '</pre>';
        return view('schedule.list', compact('schedule', 'days', 'schoolClass'));
    }

    public function createForm()
    {
        $days = Day::query()->orderBy('id')->get();
        $numLesson = NumLesson::query()->orderBy('num')->get();
        $discipline = Discipline::query()->orderBy('title')->get();
        return view('schedule.create', compact('days', 'numLesson', 'discipline'));
    }
    public function create()
    {
        //
    }
}
