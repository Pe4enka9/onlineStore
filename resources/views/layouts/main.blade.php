<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>@yield('title')</title>
</head>
<body>

<aside>
    <nav>
        <a href="{{ route('categories.index') }}" class="btn">Категории</a>
        <a href="{{ route('products.index') }}" class="btn">Товары</a>
        <a href="{{ route('orders.index') }}" class="btn">Заказы</a>
    </nav>
</aside>

<div class="container">
    @yield('content')
</div>

</body>
</html>
