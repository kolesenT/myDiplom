<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function adminPage()
    {
        $schoolClass = SchoolClass::all();
        return view('admin', compact('schoolClass'));
    }
}
