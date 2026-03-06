<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СтройИнструмент - @yield('title', 'Главная')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🔧 СтройИнструмент</a>
        <div class="navbar-nav ms-auto">
            <a href="{{ route('home') }}" class="nav-link text-white">Каталог</a>
            <a href="{{ route('cart.index') }}" class="nav-link text-white">
                🛒 Корзина
                @if(session('cart'))
                    <span class="badge bg-danger">{{ count(session('cart')) }}</span>
                @endif
            </a>
            @auth
                <a href="{{ route('orders.index') }}" class="nav-link text-white">Мои заказы</a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-warning fw-bold">Админка</a>
                @endif
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-link nav-link text-white">Выйти</button>
                </form>
            @else
                <a href="/login" class="nav-link text-white">Войти</a>
                <a href="/register" class="nav-link text-white">Регистрация</a>
            @endauth
        </div>
    </div>
</nav>
<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">© 2026 СтройИнструмент</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
