<h1>
    ADMIN
</h1>
@extends('layout')

@section('title', 'Админ Панель')
@section('content')
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('schClass.list')}}">Классы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('discipline.list')}}">Предметы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('userInfo.list')}}">Пользователи</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{route('schedule.list')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Расписание </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
{{--                            @foreach($schoolClass as $item)--}}
{{--                            <li><a class="dropdown-item" href="{{route('schedule.list', ['schoolClass'=>$item->id])}}">{{$item->num}}{{$item->letter}} Класс--}}
{{--                                </a></li>--}}
{{--                            @endforeach--}}
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row text-start">
            <div class="col-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h4>Расписание звонков </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">№ урока</th>
                                <th scope="col">Начало</th>
                                <th scope="col">Конец</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <td>{{$lesson->num}}</td>
                                    <td>{{$lesson->begin_time}}.00 </td>
                                    <td>{{$lesson->begin_time}}.{{$lesson->lesson_time}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        <a class="btn btn-primary" href="{{route('lessons')}}" role="button">Редактировать </a>
                    </div>
                </div>
                <br>
                <h3>Классы</h3>
                <ul class="list-group">
                    @foreach($schoolClass as $item)
                        <li class="list-group-item"><a class="nav-link" href="#">{{$item->num}}  {{$item->letter}} Класс</a></li>
                    @endforeach
                </ul>
                <br>
                <a class="btn btn-primary" href="{{route('schClass.createForm')}}" role="button">Добавить </a>
            </div>
            <div class="col-6">

            </div>
            <div class="col-3">
                <h3>Предметы</h3>
                <ul class="list-group">
                    @foreach($disciplines as $item)
                        <li class="list-group-item"><a class="nav-link" href="#">{{$item->title}} </a></li>
                    @endforeach
                </ul>
                <br>
                <a class="btn btn-primary" href="{{route('discipline.createForm')}}" role="button">Добавить </a>
            </div>
        </div>

@endsection
