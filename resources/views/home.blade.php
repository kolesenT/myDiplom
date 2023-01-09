@extends('layout')

@section('title', 'Главная')
@section('content')
    <div class="container">
        @if (!auth()->check())
           <div>
               <a href="{{route('sing-up.code')}}">Войти по пригласительному коду</a>
               <br>
               <a href="{{route('login')}}">Войти</a>
               <br>
           </div>
        @else
        @endif
    </div>

@endsection
