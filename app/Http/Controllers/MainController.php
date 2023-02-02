<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Discipline;
use App\Models\NumLesson;
use App\Models\Schedule;
use App\Models\SchoolClass;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function adminPage()
    {
        $schoolClass = SchoolClass::all();
        $disciplines = Discipline::all();
        $lessons = NumLesson::query()->orderBy('num')->get();
        $days = Day::query()->orderBy('id')->get();
        $user = auth()->user();
        $schedules = Schedule::query()
            ->with(['discipline', 'day', 'class', 'numLesson'])
            ->where(function ($q) use($user) {
                $q -> where('class_id', 2);
            })
            ->orderBy('day_id')
            ->orderBy('num_lesson_id')
            ->get();

//        echo '<pre>';
//        dd($schedules);
//        echo '</pre>';
        return view('home', compact('schoolClass', 'disciplines', 'lessons', 'schedules', 'days'));
    }

    public  function lessons()
    {
        return view('lesson');
    }
}
