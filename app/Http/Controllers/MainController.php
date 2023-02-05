<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Discipline;
use App\Models\Grade;
use App\Models\Journal;
use App\Models\NumLesson;
use App\Models\Schedule;
use App\Models\SchoolClass;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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
        $user = auth()->user();

        $current_class = 0;
        foreach ($user->userInfo->schoolClass as $item) {
            $current_class = $item->id;
        }

        $schedules = Schedule::query()
            ->with(['discipline', 'day', 'class', 'numLesson'])
            ->where(function ($q) use ($current_class) {
                $q->where('class_id', $current_class);
            })
            ->orderBy('day_id')
            ->orderBy('num_lesson_id')
            ->get();

        if ($schedules->count()) {
            $days = Day::query()->orderBy('id')->get();
            $current_day = Carbon::today();

            $start = Carbon::today()->subDays($current_day->dayOfWeek - 1);
            $end = Carbon::today()->addDays(7 - Carbon::today()->dayOfWeek);

            $week_period = CarbonPeriod::create($start, $end);

            $current_week = $week_period->toArray();

            $grades = Grade::with(['userInfo', 'discipline'])
                ->where(function ($q) use ($user, $start, $end) {
                    $q->where('user_info_id', $user->userInfo->id);
                    $q->whereBetween('my_date', [$start->format('Y-m-d'), $end->format('Y-m-d')]);
                })
                ->orderBy('my_date')
                ->get();

            $homeWork = Journal::query()
                ->where(function ($q) use ($current_class, $start, $end) {
                    $q->where('class_id', $current_class);
                    $q->whereBetween('my_date', [$start->format('Y-m-d'), $end->format('Y-m-d')]);
                })
                ->orderBy('my_date')
                ->get();
        } else {
            $current_week = 0;
            $grades = 0;
            $days = [];
            $homeWork = [];
        }

        return view('home', compact(
            'schoolClass',
            'disciplines',
            'lessons',
            'schedules',
            'days',
            'current_week',
            'grades',
            'homeWork'
        ));
    }

    public function lessons()
    {
        return view('lesson');
    }
}
