@extends('layout')

@section('title', 'Журнал')
@section('content')
    <h2>Журнал {{$schoolClass->num}} {{$schoolClass->letter}} класса </h2>
    <br>
    <div class="container row mt-4">
        <div class="col-md-8">
            <form action="{{route('journal.show', ['schoolClass' => $schoolClass->id])}}">
                <select name="discipline" class="form-select" aria-label="Default select example">
                    <option value="" selected> Предмет</option>
                    @if($current_disc == 0)
                        @foreach($discipline as $disc)
                            <option value="{{$disc->id}}"> {{$disc->title}} </option>
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
            @if($current_disc > 0)
                <div class="container overflow-auto">
                    <table class="table table-bordered border-primary">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 20rem"> ФИО</th>
                            @foreach($lessonDays as $item)
                                <th scope="col"><span
                                        style="writing-mode: vertical-lr; transform: rotate(180deg)">  {{ $item->format('d.m')}}  </span>
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->fullname }}</td>

                                @foreach($lessonDays as $date)
                                    <td>
                                        @foreach($grades as $grade)
                                            @if($grade->iser_info_id == $user->id)
                                                <label>{{ $grade->grade ?? ' ' }}</label>
{{--                                                <label>{{ $grade["$user->id:$date"] ?? ' ' }}</label>--}}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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
