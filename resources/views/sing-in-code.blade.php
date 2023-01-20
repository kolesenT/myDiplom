@extends('layout')

@section('title', 'Code')

@section('content')
<div class="container">
    <form action="{{route('sing-up.code')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="code_new">{{ __('validation.attributes.code') }}</label>
            <input value="{{ old ('code_new') }}" name="code_new" type ="text" class="form-control @error('code_new') is-invalid @enderror"
                   placeholder="Введите пригласительный код">
            @error('code_new')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <br>
        <button class="btn btn-primary" type="submit"> Войти</button>
    </form>
</div>

@endsection

