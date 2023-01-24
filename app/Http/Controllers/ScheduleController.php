<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Schedule;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function list()
    {
        $schedule = Schedule::query()
            ->with(['days', 'class', 'discipline', 'numLesson'])
            ->orderBy('days_id')->get();

        $days = Day::query()->orderBy('id')->get();
        $schoolClass = SchoolClass::find(1);
//        echo '<pre>';
//           dd($schoolClass);
//           echo '</pre>';
        return view('schedule.list', compact('schedule', 'days', 'schoolClass'));
    }
}
