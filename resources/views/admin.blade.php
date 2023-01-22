<h1>
    ADMIN
</h1>
@extends('layout')

@section('title', 'Админ Панель')
@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
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
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            Dropdown link--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                            <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                            <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </nav>

        <div class="row text-start">
            <div class="col-3">
                <h3>Классы</h3>
                <ul class="list-group">
                    @foreach($schoolClass as $item)
                        <li class="list-group-item"><a class="nav-link" href="#">{{$item->num}}  {{$item->letter}} Класс</a></li>
                    @endforeach
                </ul>
                <br>
                <a class="btn btn-primary" href="{{route('schClass.createForm')}}" role="button">Добавить </a>
            </div>
            <div class="col-6">col-6</div>
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
    </div>

@endsection
