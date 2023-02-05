@extends('layout')

@section('title', 'Класс')

@section('content')
    <h2> Ученики {{$schoolClass->num}} {{$schoolClass->letter}} класса</h2>
    <br>
    <div class="container row mt-4">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ученики</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->fullname}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary" href="{{route('schClass.addUsersForm', ['schoolClass' => $schoolClass->id])}}"
               role="button">
                Добавить ученика</a>
        </div>
    </div>
@endsection
