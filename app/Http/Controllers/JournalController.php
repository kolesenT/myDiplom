<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Journal;
use App\Models\Period;
use App\Models\SchoolClass;
use App\Models\User_info;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function show(SchoolClass $schoolClass, Request $request)
    {
        $period = Period::query()->first();
        $query = Journal::query()
            ->where('class.id', $schoolClass->id)
            ->orderByDesc('my_date');

        $my_disc = $request->has('discipline') ? $request->get('discipline'): 0;

        $discipline = $my_disc ?
            Discipline::query()-> where('id', $request->get('discipline'))->first() :
            Discipline::query()->orderBy('title')->get();

//                            echo '<pre>';
//        dd($discipline);
//        echo '</pre>';

        $users = $my_disc ? $schoolClass->users : null;

        if ($request->has('discipline')) {
            $query->whereHas('discipline', function ($q) use ($request) {
                $q->where('discipline.id', $request->get('discipline'));
            });

            //$users = $schoolClass->users;
//                    echo '<pre>';
//        dd($query);
//        echo '</pre>';

        }


        return view('journal.show', compact('schoolClass', 'my_disc', 'period', 'discipline', 'users'));
    }
}
