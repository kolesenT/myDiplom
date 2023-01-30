@extends('layout')

@section('title', 'Добавить рассписание')

@section('content')

<h1>CREATE</h1>
<form action="{{route('schedule.create')}}" method="post">
    @csrf
    <div class="col-sm-6">
     <div class="card border-primary mb-4">
        <br>
        <h5>День недели</h5>
        <select name="days" class="form-select" aria-label="Default select example">
            @foreach($days as $day)
              <option value="{{$day->id}}">{{$day->title}}</option>
            @endforeach
        </select>
        <br>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">№ урока</th>
                <th scope="col">Название предмета</th>
            </tr>
            </thead>
            <tbody>
                @foreach($numLesson as $item)
                    <tr>
                        <td>{{$item->num}}</td>
                        <td>
                            <select name="lesson[{{$item->num}}]" class="form-select" aria-label="Default select example">
                                <option value="" selected>Предмет</option>
                                @foreach($discipline as $d)
                                    <option value="{{$d->id}}">{{$d->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
     </div>
    </div>
    <br>
    <input name="schoolClass" value="{{$schoolClass->id}}" hidden="true">
    <button class="btn btn-primary" type="submit"> Добавить </button>
</form>
@endsection
