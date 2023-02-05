<?php

namespace App\Http\Controllers;

use App\Services\MainService;

class MainController extends Controller
{
    public function __construct(private MainService $mainService)
    {
    }

    public function index()
    {
        return view('welcome');
    }

    public function adminPage()
    {
        $user = auth()->user();
        $result = $this->mainService->adminPage($user);

        return view('home', $result);
    }

    public function lessons()
    {
        return view('lesson');
    }
}
