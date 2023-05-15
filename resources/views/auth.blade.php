@extends('layouts.app')

@section('title-block')Авторизация@endsection

@section('content')
    
    <h1>Авторизуйтесь для просмотра курса валют</h1>

    <form action="{{ route('auth-form') }}" method="post">
        @csrf

        <div>
            <label for="login">Введите логин</label>
            <input type="text" name="login" placeholder="Введите логин" id="login">
        </div>

        <div>
            <label for="password">Введите пароль</label>
            <input type="text" name="password" placeholder="***" id="password">
        </div>

        <button type="submit" name="button">Авторизоваться</button>
    </form>
    @if (isset($message))
        <div>
            Вы не прошли авторизацию. Попробуйте снова.
        </div>
    @endif
@endsection