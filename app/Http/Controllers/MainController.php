<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Discipline;
use App\Models\Grade;
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
        //$days = Day::query()->orderBy('id')->get();
        $user = auth()->user();

        //Как узнать в каком классе учится ученик? (может быть кто-то другой и у него нет класса)
        //Не знаю как правильно реализовать закомментированный запрос через Model
        //2 для примера, так это $user->userInfo->id
//        select distinct class_user_info.class_id
//        from user_info, users, class_user_info
//        where user_info.id = users.user_info_id and
//        class_user_info.user_info_id = user_info.id and
//        user_info.id = 2;

        //пока как-то так, хотя запись одна!!!
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
        } else {
            $current_week = 0;
            $grades = 0;
            $days = [];
        }

        return view('home', compact('schoolClass', 'disciplines', 'lessons', 'schedules',
            'days', 'current_week', 'grades'));
    }

    public function lessons()
    {
        return view('lesson');
    }
}
