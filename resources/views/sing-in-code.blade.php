@extends('layout')

@section('title', 'Вход')

@section('content')
    <div class="container">

        @if($errors->any())
            <div class="alert alert-danger">Error!</div>
        @endif
        <form action="{{route('sing-up.code')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="code_new">{{ __('validation.attributes.code_new') }}</label>
                <input value="{{ old ('code_new')}}" name="code_new" type="text"
                       class="form-control @error('code_new') is-invalid @enderror">
                @error('code_new')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <br>
            <button class="btn btn-primary" type="submit"> Войти</button>
        </form>
    </div>

@endsection

