@extends('layouts.app')
@section('title', 'Корзина')
@section('content')
<h1 class="mb-4">🛒 Корзина</h1>
@if(empty($cart))
    <div class="alert alert-info">Корзина пуста. <a href="{{ route('home') }}">Перейти в каталог</a></div>
@else
<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
            <th>Удалить</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $id => $item)
        @php $total += $item['price'] * $item['quantity']; @endphp
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['price'], 2) }} ₽</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ number_format($item['price'] * $item['quantity'], 2) }} ₽</td>
            <td>
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">✕</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-end fw-bold">Итого:</td>
            <td colspan="2" class="fw-bold text-success">{{ number_format($total, 2) }} ₽</td>
        </tr>
    </tfoot>
</table>
<div class="d-flex justify-content-between">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Продолжить покупки</a>
    @auth
        <a href="{{ route('checkout') }}" class="btn btn-success btn-lg">Оформить заказ →</a>
    @else
        <a href="/login" class="btn btn-primary">Войдите для оформления</a>
    @endauth
</div>
@endif
@endsection
