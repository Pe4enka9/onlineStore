@extends('layouts.main')
@section('title', $category->name)

@section('content')
    <a href="{{ route('categories.index') }}" class="btn mb-2">Назад</a>

    <h1 class="mb-2">{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
@endsection
