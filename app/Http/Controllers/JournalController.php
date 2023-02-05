<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Services\JournalService;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function __construct(private JournalService $journalServices)
    {
    }

    public function show(SchoolClass $schoolClass, Request $request)
    {
        $current_disc = $request->has('discipline') ? $request->get('discipline') : 0;

        $result = $this ->journalServices ->show($schoolClass, $current_disc);

        return view('journal.show', array_merge(compact(
            'schoolClass',
            'current_disc'
        ), $result));
    }
}
