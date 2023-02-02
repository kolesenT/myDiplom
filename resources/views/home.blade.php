@extends('layout')

@section('title', 'Админ Панель')
@section('content')

        <div class="d-flex flex-row mb-3 justify-content-between" style="flex-wrap: wrap">
            @foreach($days as $day)
                <div class="card mb-3" style="min-width: 400px;">
                    <div class="card-header">
                        <h3>{{$day->title}} </h3>
                    </div>
                    @foreach($schedules as $schedule)
                        @if($day->id == $schedule->day->id)
                            <div class="card-body">
                                <h4 class="card-title">{{$schedule->discipline->title}}</h4>
                                <p class="card-text">Нету д/з</p>
                                <p class="card-text">{{$schedule->numLesson->begin_time}}.00 -
                                    {{$schedule->numLesson->begin_time}}.{{$schedule->numLesson->lesson_time}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
@can('view', \App\Models\User_info::class)
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
           <div  class="col-6">

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
@endcan
@endsection
