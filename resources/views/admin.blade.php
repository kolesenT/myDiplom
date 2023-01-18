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
                        <a class="nav-link" href="#">Учителя</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Родители</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Добавить пользователя</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row text-start">
            <div class="col-3">
                <ul class="list-group">
                    @foreach($schoolClass as $item)
                        <li class="list-group-item"><a class="nav-link" href="#">{{$item->num}}  {{$item->letter}} Класс</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6">col-6</div>
            <div class="col-3">col-3</div>
        </div>
    </div>

@endsection
