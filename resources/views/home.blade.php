@extends('layout')

@section('title', 'Главная')
@section('content')
    <div class="container">
        @if (!auth()->check())
            <div>
                <a href="{{route('sing-up.codeForm')}}">Войти по пригласительному коду</a>
                <br>
                <a href="{{route('sing-in')}}">Регистрация</a>
                <br>
                <a href="{{route('login')}}">Войти</a>
                <br>
            </div>
        @else
            <div class="container">

            </div>
            <form action="#" method="post" class="form-check-inline">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form>
        @endif
    </div>

@endsection

