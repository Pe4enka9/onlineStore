@extends('layouts.main')
@section('title', 'Категории')

@section('content')
    <h1 class="mb-2">Категории</h1>

    <a href="{{ route('categories.create', ['page' => request()->get('page', 1)]) }}" class="btn mb-2">Добавить</a>

    <div class="card-container mb-2">
        @foreach($categories as $category)
            <div class="card">
                <h2>{{ $category->name }} (ID: {{ $category->id }})</h2>

                @if($category->description)
                    <p>{{ $category->description }}</p>
                @endif

                <p>Товаров в категории: {{ $category->products_count }}</p>

                <div class="buttons">
                    <a href="{{ route('categories.show', $category) }}" class="btn">Подробнее</a>
                    <a href="{{ route('categories.edit', ['category' => $category, 'page' => request()->get('page', 1)]) }}"
                       class="btn">Изменить</a>
                    @if(!$category->products_count)
                        <form
                            action="{{ route('categories.destroy', ['category' => $category, 'page' => request()->get('page', 1)]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Удалить</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{ $categories->links() }}
@endsection
