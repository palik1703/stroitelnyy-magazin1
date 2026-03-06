@extends('layouts.app')
@section('title', 'Оформление заказа')
@section('content')
<h1 class="mb-4">📋 Оформление заказа</h1>
<div class="row">
    <div class="col-md-7">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Адрес доставки *</label>
                <input type="text" name="address" class="form-control" required
                       placeholder="г. Москва, ул. Примерная, д. 1">
                @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Телефон *</label>
                <input type="text" name="phone" class="form-control" required
                       placeholder="+7 (999) 000-00-00">
                @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">✅ Подтвердить заказ</button>
        </form>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-dark text-white"><strong>Ваши товары</strong></div>
            <ul class="list-group list-group-flush">
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span>{{ number_format($item['price'] * $item['quantity'], 2) }} ₽</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between fw-bold bg-light">
                    <span>Итого:</span>
                    <span class="text-success">{{ number_format($total, 2) }} ₽</span>
                </li>
            </ul>
        </div>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">← Вернуться в корзину</a>
    </div>
</div>
@endsection
