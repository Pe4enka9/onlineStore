@extends('layouts.main')
@section('title', 'Изменить товар')

@section('content')
    <h1 class="mb-2">Изменить товар</h1>

    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @include('products.form')

        <div class="buttons">
            <button type="submit" class="btn">Изменить</button>
            <a href="{{ route('products.index') }}" class="btn danger">Отмена</a>
        </div>
    </form>
@endsection
