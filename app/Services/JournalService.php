<?php

namespace App\Services;

use App\Models\Discipline;
use App\Models\Grade;
use App\Models\Period;
use App\Models\Schedule;
use App\Models\SchoolClass;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Traits\Creator;

//use Illuminate\Support\Collection;

class JournalService
{
    public function show(SchoolClass $schoolClass, int $current_disc): array
    {
        $period = Period::query()->first();

        $days_collection = Schedule::where(function ($q) use ($schoolClass, $current_disc) {
            $q->where('class_id', $schoolClass->id);
            $q->where('discipline_id', $current_disc);
        })
            ->orderBy('day_id')
            ->get('day_id');

        $daysNumber = [];
        foreach ($days_collection as $day) {
            $daysNumber[] = $day->day_id;
        }

        $daysPeriod = CarbonPeriod::between(
            new Carbon($period->begin_period),
            new Carbon($period->end_period)
        );

        $lessonDays = [];
        foreach ($daysPeriod as $item) {
            if (in_array($item->dayOfWeek, $daysNumber)) {
                $lessonDays[] = $item;
            }
        }

        $discipline = $current_disc ?
            Discipline::query()->where('id', $current_disc)->first() :
            Discipline::query()->orderBy('title')->get();

        $users = $current_disc ? $schoolClass->users : null;

        $grades = Grade::query()
            ->  with(['userInfo'])
            ->  where(function ($q) use ($current_disc, $users, $period) {
                $q->where('discipline_id', $current_disc);
                $q->whereBetween('my_date', [$period->begin_period, $period->end_period]);
            })
            ->orderBy('my_date')
            ->get();

        return compact('period', 'discipline', 'users', 'lessonDays', 'grades');
    }
}
