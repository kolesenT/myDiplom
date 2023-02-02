<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\CreateRequest;
use App\Models\Day;
use App\Models\Discipline;
use App\Models\NumLesson;
use App\Models\Schedule;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;

class ScheduleController extends Controller
{
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

        foreach ($lessons as $key => $value)
        {
            if ($value)
            {
                $query = Schedule::query()
                ->where('class_id', $current_class)
                ->where('day_id', $day)
                ->where('num_lesson_id', $key)
                ->count();

                $schedule = !$query ? new Schedule() :
                    Schedule::query()
                    ->where('class_id', $current_class)
                    ->where('day_id', $day)
                    ->where('num_lesson_id', $key)
                    ->first();

                $schedule -> day_id = $day;
                $schedule -> class_id = $current_class;
                $schedule -> num_lesson_id = $key;
                $schedule -> discipline_id = $value;
                $schedule -> save();
            }
        }
        session()->flash('success', 'Success!');
        return redirect()->route('schedule.list', ['schoolClass' =>  $current_class]);
    }
}
