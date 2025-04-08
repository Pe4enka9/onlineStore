@extends('layouts.main')
@section('title', 'Добавить категорию')

@section('content')
    <h1 class="mb-2">Добавить категорию</h1>

    <form action="{{ route('categories.store', ['page' => request()->get('page', 1)]) }}" method="post">
        @csrf

        @include('categories.form')

        <div class="buttons">
            <button type="submit" class="btn">Добавить</button>
            <a href="{{ route('categories.index') }}" class="btn danger">Отмена</a>
        </div>
    </form>
@endsection
