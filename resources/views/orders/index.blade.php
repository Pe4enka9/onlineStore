@extends('layouts.main')
@section('title', 'Заказы')

@section('content')
    <h1 class="mb-2">Заказы</h1>

    <div class="card-container">
        @foreach($orders as $order)
            <div class="card">
                <h2>{{ $order->product->name }} (ID: {{ $order->id }})</h2>
                <p>Email пользователя: {{ $order->user->email }}</p>
                <p>Цена: {{ $order->price }} &#8381;</p>
                <p>
                    Статус: {{ ($order->status_id === 1 ? 'В процессе' : ($order->status_id === 2 ? 'Оплачено' : 'Не оплачено')) }}</p>
            </div>
        @endforeach
    </div>
@endsection
