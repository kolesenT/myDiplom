@extends('layout')

@section('title', 'Добавить предмет')

@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">Error!</div>
    @endif
    <form action="{{route('discipline.create')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">{{ __('validation.attributes.discipline') }}</label>
            <input value="{{ old ('discipline')}}" name="title" type ="text" class="form-control @error('discipline') is-invalid @enderror">
            @error('discipline')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <br>
        <button class="btn btn-primary" type="submit"> Добавить </button>
    </form>
</div>

@endsection
