@extends('layout')

@section('title', 'Классы')

@section('content')
    <div class="container row mt-4">
        <div class="col-md-8">
            <h3>{{$userInfo -> fullname}}</h3>
            <h6>({{$userInfo -> role -> name}})</h6>
            <br>
            <h4></h4>
            <br>

            @if($userInfo->code->is_use == 0)
                <h5>Пригласительный код</h5>
                <h4>{{$userInfo->code->code_new}}</h4>
            @else
                <h5>Email</h5>
                <h4>{{$userInfo->user->email}}</h4>
            @endif

        </div>
    </div>
@endsection
