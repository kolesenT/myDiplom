<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Grade;
use App\Models\Journal;
use App\Models\Period;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\User_info;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function show(SchoolClass $schoolClass, Request $request)
    {
        $period = Period::query()->first();

        $current_disc = $request->has('discipline') ? $request->get('discipline') : 0;

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
            Discipline::query()->where('id', $request->get('discipline'))->first() :
            Discipline::query()->orderBy('title')->get();

        $users = $current_disc ? $schoolClass->users : null;

        $grades = Grade::query()
            ->with(['userInfo'])
            ->where(function ($q) use ($current_disc, $users, $period) {
                $q->where('discipline_id', $current_disc);
                $q->whereBetween('my_date', [$period->begin_period, $period->end_period]);
            })
            ->orderBy('my_date')
            ->get();

//        $grades = [];
//        foreach ($classGrade as $item) {
//            $grades["$item->userInfo->id:$item->my_date"] = $item->grade;
//        }


//foreach ($users as $user){
//    echo '<pre>';
//    dd($user->grades->where('discipline_id', $my_disc));
//    //$user->grades->where('discipline_id', $my_disc)->get('grade')
//    //$user->grades->where('discipline_id', $my_disc)->where('my_date', $my_date[0])->first
//    echo '</pre>';
//}
//        if ($request->has('discipline')) {
//            $query->whereHas('discipline', function ($q) use ($request) {
//                $q->where('discipline.id', $request->get('discipline'));
//            });
//        }

        return view('journal.show', compact('schoolClass', 'current_disc', 'period',
            'discipline', 'users', 'lessonDays', 'grades'));
    }
}

