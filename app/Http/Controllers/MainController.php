<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\NumLesson;
use App\Models\SchoolClass;
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
        return view('home', compact('schoolClass', 'disciplines', 'lessons'));
    }

    public  function lessons()
    {
        return view('lesson');
    }
}
