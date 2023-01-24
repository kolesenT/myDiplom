@extends('layout')

@section('title', 'Классы')

@section('content')
    <div class="container row mt-4">
        <div class="col-md-8">
            <h3>{{$userInfo -> fullname}}</h3>
            <h6>({{$userInfo -> role -> name}})</h6>
        </div>
    </div>
@endsection
