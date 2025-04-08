@extends('layouts.main')
@section('title', 'Изменить категорию')

@section('content')
    <h1 class="mb-2">Изменить категорию</h1>

    <form action="{{ route('categories.update', ['category' => $category, 'page' => request()->get('page', 1)]) }}"
          method="post">
        @csrf
        @method('PATCH')

        @include('categories.form')

        <div class="buttons">
            <button type="submit" class="btn">Изменить</button>
            <a href="{{ route('categories.index') }}" class="btn danger">Отмена</a>
        </div>
    </form>
@endsection
