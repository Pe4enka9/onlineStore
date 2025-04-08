@extends('layouts.main')
@section('title', 'Товары')

@section('content')
    <h1 class="mb-2">Товары</h1>

    <a href="{{ route('products.create') }}" class="btn mb-2">Добавить</a>

    <div class="card-container">
        @foreach($products as $product)
            <div class="card">
                <h2>{{ $product->name }} (ID: {{ $product->id }})</h2>

                @if($product->description)
                    <p>{{ $product->description }}</p>
                @endif

                <div class="img-container">
                    <img src="{{ $product->image_url }}" alt="Фото товара">
                </div>

                <p>Цена: {{ $product->price }} &#8381;</p>
                <p>Категория: {{ $product->category->name }}</p>

                <div class="buttons">
                    <a href="{{ route('products.show', $product) }}" class="btn">Подробнее</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn">Изменить</a>

                    <form action="{{ route('products.destroy', $product) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn danger">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
