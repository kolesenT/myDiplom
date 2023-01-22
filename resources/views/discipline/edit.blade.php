@extends('layout')

@section('title', 'Редактировать предмет')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">Error!</div>
        @endif
        <form action="{{route('discipline.edit', ['discipline' => $discipline->id])}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">{{ __('validation.attributes.discipline') }}</label>
                <input value="{{ old ('discipline', $discipline->title) }}" name="title" type ="text" class="form-control @error('discipline') is-invalid @enderror">
                @error('discipline')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <br>
            <button class="btn btn-primary" type="submit"> Сохранить </button>
        </form>
    </div>

@endsection

