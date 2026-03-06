@extends('layouts.app')
@section('title', 'Заказ #' . $order->id)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🧾 Заказ #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Назад</a>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Информация о заказе</div>
            <div class="card-body">
                <p><strong>Покупатель:</strong> {{ $order->user->name ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? '—' }}</p>
                <p><strong>Телефон:</strong> {{ $order->phone }}</p>
                <p><strong>Адрес:</strong> {{ $order->address }}</p>
                <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                <p><strong>Статус:</strong>
                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                        {{ $order->status }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-white">Товары в заказе</div>
            <table class="table table-bordered mb-0">
                <thead>
                    <tr><th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th></tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Товар удалён' }}</td>
                        <td>{{ number_format($item->price, 2) }} ₽</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} ₽</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Итого:</td>
                        <td class="fw-bold text-success">{{ number_format($order->total, 2) }} ₽</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
