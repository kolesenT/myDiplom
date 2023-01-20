<?php

namespace App\Http\Controllers;


use App\Http\Requests\Code\CodeRequest;
use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function singUpCodeForm()
    {
        return view('sing-up-code');
    }

    public function singUpCode(CodeRequest $request)
    {
        $data = $request -> validated();

        if ($request -> has('code_new')){
            $code = $request->code_new;

            $query = Code::query();
//            echo '<pre>';
//            dump($query->where('code_new', '00000000')->first());
//            echo '</pre>';

            if ($query->where('code_new', $code)->first()) {
                view('sing-in.form');
            }
            else{
                session()->flash('error', 'code not found!');

                return redirect()->route('home');
            }




        }

    }
}
