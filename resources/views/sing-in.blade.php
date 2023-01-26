@extends('layout')

@section('title', 'Регистрация')

@section('content')
    <div class="row">
        <h3>{{$user_info->fullname}}</h3>
        <br>
        <form action="{{route('sing-in')}}" method="post">
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

            <div class="form-group">
                <label for="password_confirmation">{{ __('validation.attributes.password_confirmation') }}</label>
                <input value="{{ old ('password_confirmation') }}" name="password_confirmation" type ="password" class="form-control @error('password') is-invalid @enderror">
                @error('password_confirmation')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <br>
                <input hidden="true" name="user_info" value="{{$user_info->id}}">

            <div class="form-group">
                <button class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

