@extends('layouts.main')
@section('title', $product->name)

@section('content')
    <a href="{{ route('products.index') }}" class="btn mb-2">Назад</a>

    <h1 class="mb-2">{{ $product->name }}</h1>

    <div class="info">
        <p>{{ $product->description }}</p>

        <div class="img-container">
            <img src="{{ $product->image_url }}" alt="Фото товара">
        </div>

        <p>Цена: {{ $product->price }} &#8381;</p>
        <p>Категория: {{ $product->category->name }}</p>
    </div>
@endsection
