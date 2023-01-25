@extends('layout')

@section('title', 'Рассписание')
@section('content')
<div>
    <h2>Расписание занятий {{$schoolClass->num}}{{$schoolClass->letter}} класса</h2>
    <br>
</div>
    <br>
<div class="row">
    @foreach($days as $day)
    <div class="col-sm-6">
        <div class="card border-primary mb-4">
            <h5 class="card-title">{{$day->title}}</h5>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">№ урока</th>
                    <th scope="col">Начало</th>
                    <th scope="col">Конец</th>
                    <th scope="col">Название предмета</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($schedule as $item)
{{--                        @if($item->days->contains('id', $day->id))--}}
                        <tr>
                            <td>{{$item->numLesson->num}}</td>
                            <td>{{$item->numLesson->begin_time}}.00 </td>
                            <td>{{$item->numLesson->begin_time}}.{{$item->numLesson->lesson_time}}</td>
                            <td>{{$item->discipline->title}}</td>
                        </tr>
{{--                        @endif--}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
<br>
<a class="btn btn-primary" href="{{route('schedule.createForm')}}" role="button">Добавить </a>
@endsection
