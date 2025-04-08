@extends('layouts.main')
@section('title', 'Авторизация')

@section('content')
    <h1 class="mb-2">Авторизация</h1>

    <form action="{{ route('auth.auth') }}" method="post">
        @csrf

        <div class="input-container">
            <input type="email" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}">
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="input-container">
            <input type="password" name="password" id="password" placeholder="Пароль">
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        @error('auth') <p class="error">{{ $message }}</p> @enderror

        <button type="submit" class="btn">Войти</button>
    </form>
@endsection
