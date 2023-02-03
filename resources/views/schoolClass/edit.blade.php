@extends('layout')

@section('title', 'Добавить класс')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">Error!</div>
        @endif
        <form action="{{route('schClass.edit', ['schoolClass' => $schoolClass -> id])}}" method="post">
            @csrf

            <div class="form-group">
                <label for="num">{{ __('validation.attributes.class') }}</label>
                <input value="{{ old ('class', $schoolClass -> num)}}" name="num" type="text"
                       class="form-control @error('class') is-invalid @enderror">
                @error('class')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="letter">{{ __('validation.attributes.letter') }}</label>
                <input value="{{ old ('class', $schoolClass -> letter)}}" name="letter" type="text"
                       class="form-control @error('letter') is-invalid @enderror">
                @error('letter')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <br>
            <button class="btn btn-primary" type="submit"> Сохранить</button>
        </form>
    </div>

@endsection
