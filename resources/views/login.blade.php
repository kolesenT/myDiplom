@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">Error!</div>
        @endif
        <form action="{{route('login-in')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('validation.attributes.email') }}</label>
                <input value="{{ old ('email') }}" name="email" type ="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('validation.attributes.password') }}</label>
                <input value="{{ old ('password') }}" name="password" type ="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <br>
            <button class="btn btn-primary" type="submit"> Войти</button>
        </form>
    </div>
@endsection

