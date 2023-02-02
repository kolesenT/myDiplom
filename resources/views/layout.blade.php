<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
   <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-primary mb-4">
            <div class="container-fluid">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"/>
                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"/>
                </svg>
                <a class="navbar-brand" href="#"><h1>Дневник </h1></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if(auth()->check())
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Главная</a>
                        </li>
                        @can('view', \App\Models\SchoolClass::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('schClass.list')}}">Классы</a>
                        </li>
                        @endcan
                        @can('view', \App\Models\Discipline::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('discipline.list')}}">Предметы</a>
                        </li>
                        @endcan

                        @can('view', \App\Models\User_info::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('userInfo.list')}}">Пользователи</a>
                        </li>
                        @endcan
                        @can('view', \App\Models\Schedule::class)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                Расписание
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(\App\Models\SchoolClass::query()->orderBy('num')->get() as $item)
                                  <li><a class="dropdown-item" href="{{route('schedule.list', ['schoolClass'=>$item->id])}}">
                                          {{$item->num}} {{$item->letter}} класс</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endcan
                        @can('view', \App\Models\Journal::class)

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                Журнал
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(\App\Models\SchoolClass::query()->orderBy('num')->get() as $item)
                                    <li><a class="dropdown-item" href="{{route('journal.show', ['schoolClass'=>$item->id])}}">
                                            {{$item->num}} {{$item->letter}} класс</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endcan

                    </ul>
                    @endif
                    @if(auth()->check())
                        <div class="d-flex">
                            <form action="{{route('logout')}}" method="post" class="form-check-inline">
                                @csrf
                                <p class="d-inline-block">Вы вошли как {{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                                <button class="btn btn-primary">Выход</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
   </nav>
</div>
<div class="container">
    @include('flash-messages')
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
