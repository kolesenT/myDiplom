@extends('layout')

@section('title', 'Журнал')
@section('content')
    <h2>Журнал {{$schoolClass->num}} {{$schoolClass->letter}} класса </h2>
    <br>
    <div class="container row mt-4">
        <div class="col-md-8">
            <form action="{{route('journal.show', ['schoolClass' => $schoolClass->id])}}">
                <select name="discipline" class="form-select" aria-label="Default select example">
                    <option value="" selected> Предмет </option>
                    @if($discipline->count() > 1)
                     @foreach($discipline as $d)
                        <option value="{{$d->id}}"> {{$d->title}} </option>
                     @endforeach
                    @else
                        <option value="{{$discipline->id}}" selected> {{$discipline->title}} </option>
                    @endif
                </select>
                <br>
                <button class="btn btn-primary">Показать</button>
            </form>
            <br>
            <div class="d-flex justify-content-between">
                <div>{{$period->begin_period}}</div>
                <div>{{$period->end_period}}</div>
            </div>
            <br>
            @if($my_disc > 0)
            <table>
                <thead>
                <tr>
{{--                    <th scope="col">№ </th>--}}
                    <th scope="col"> ФИО </th>
                    <th scope="col"> Дата </th>
                    <th scope="col"> Оценка </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->fullname }}</td>
                            <td> 1 </td>
                            <td> 5 </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h2>Выберите предмет!</h2>
            @endif
        </div>
        <div class="col-md-4">
            <div class="container">
                <h4> Добавить Д/З</h4>
            </div>
        </div>
    </div>
@endsection
