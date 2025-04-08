@extends('layouts.main')
@section('title', 'Добавить товар')

@section('content')
    <h1 class="mb-2">Добавить товар</h1>

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('products.form')

        <div class="buttons">
            <button type="submit" class="btn">Добавить</button>
            <a href="{{ route('products.index') }}" class="btn danger">Отмена</a>
        </div>
    </form>
@endsection
