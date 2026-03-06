@extends('layouts.app')
@section('title', 'Мои заказы')
@section('content')
<h1 class="mb-4">🧾 Мои заказы</h1>

@if($orders->isEmpty())
    <div class="alert alert-info">
        У вас пока нет заказов. <a href="{{ route('home') }}">Перейти в каталог</a>
    </div>
@else
    @foreach($orders as $order)
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Заказ #{{ $order->id }}</strong>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                @php
                    $badgeColor = match($order->status) {
                        'completed'  => 'success',
                        'cancelled'  => 'danger',
                        'shipped'    => 'primary',
                        'processing' => 'info',
                        default      => 'warning'
                    };
                    $statusLabel = match($order->status) {
                        'pending'    => '⏳ Ожидает',
                        'processing' => '⚙️ Обрабатывается',
                        'shipped'    => '🚚 Отправлен',
                        'completed'  => '✅ Завершён',
                        'cancelled'  => '❌ Отменён',
                        default      => $order->status
                    };
                @endphp
                <span class="badge bg-{{ $badgeColor }} fs-6">{{ $statusLabel }}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>📍 Адрес:</strong> {{ $order->address }}</p>
                    <p class="mb-1"><strong>📞 Телефон:</strong> {{ $order->phone }}</p>
                    <p class="mb-0"><strong>💰 Сумма:</strong>
                        <span class="text-success fw-bold fs-5">{{ number_format($order->total, 2) }} ₽</span>
                    </p>
                </div>
                <div class="col-md-6">
                    {{-- Товары в заказе --}}
                    @if($order->items && $order->items->count() > 0)
                    <p class="mb-2"><strong>🛒 Товары:</strong></p>
                    <ul class="list-unstyled mb-0">
                        @foreach($order->items as $item)
                        <li class="small text-muted">
                            • {{ $item->product->name ?? 'Товар удалён' }}
                            × {{ $item->quantity }} шт. —
                            {{ number_format($item->price * $item->quantity, 2) }} ₽
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
@endsection
