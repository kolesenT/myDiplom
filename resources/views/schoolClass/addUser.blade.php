@extends('layout')

@section('title', 'Добавить ученика')

@section('content')
{{--    <h2>Добавить ученика для  {{$schoolClass-> num}} {{$schoolClass->letter}} класса</h2>--}}
{{--    <form action="{{route('schClass.addUsers', ['schoolClass'=>$schoolClass->id])}}" method="post">--}}
{{--        @csrf--}}
{{--        <select name="schoolClass[{{$schoolClass->id}}]" class="form-select" multiple aria-label="multiple select example">--}}
{{--            @foreach($users as $user)--}}
{{--                <option value="{{$user->id}}"> {{$user->fullname}} </option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <br>--}}
{{--        <button class="btn btn-primary" type="submit"> Добавить </button>--}}
{{--    </form>--}}
@endsection

