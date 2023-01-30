<?php

namespace App\Http\Controllers;


use App\Http\Requests\Code\CodeRequest;
use App\Models\Code;
use App\Models\User_info;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function singUpCodeForm()
    {
        return view('sing-in-code');
    }

    public function singUpCode(CodeRequest $request)
    {
        if ($request -> has('code_new')){
            $code = $request->code_new;

            $query = Code::query()->where('code_new', $code)->first();

            if ($query)
            {
                $user_info = User_info::query()->where('code_id', $query->id)->first();

                return view('sing-in', compact('user_info'));
            }
            else{
                session()->flash('error', 'code not found!');

                return redirect()->route('welcome');
            }




        }

    }
}
