@extends('layout')

@section('title', 'Добавить пользователя')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">Error!</div>
        @endif
        <form action="{{route('users.create')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="surname">{{ __('validation.attributes.surname') }}</label>
                <input value="{{ old ('surname')}}" name="surname" type="text"
                       class="form-control @error('surname') is-invalid @enderror">
                @error('surname')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="name">{{ __('validation.attributes.name') }}</label>
                <input value="{{ old ('name')}}" name="name" type="text"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="patronymic">{{ __('validation.attributes.patronymic') }}</label>
                <input value="{{ old ('patronymic')}}" name="patronymic" type="text"
                       class="form-control @error('patronymic') is-invalid @enderror">
                @error('patronymic')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="">Пол</label>

                @foreach($gender as $item)
                    <div class="form-check">
                        <input type="radio" name="gender" value="{{$item->id}}"
                               class="form-check-input"> {{$item->gender}}
                    </div>
                @endforeach
            </div>
            <br>
            <div class="form-group">
                <label for="">Роль</label>

                @foreach($roles as $role)
                    <div class="form-check">
                        <input type="radio" name="roles" value="{{$role->id}}" class="form-check-input"> {{$role->name}}
                    </div>
                @endforeach
            </div>
            <br>
            <button class="btn btn-primary" type="submit"> Добавить</button>
        </form>
    </div>

@endsection

