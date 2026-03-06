@extends('layouts.app')
@section('title', 'Управление заказами')
@section('content')
<h1 class="mb-4">🧾 Все заказы</h1>

@if($orders->isEmpty())
    <div class="alert alert-info">Заказов пока нет.</div>
@else
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Покупатель</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>Сумма</th>
            <th>Статус</th>
            <th>Дата</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? '—' }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->address }}</td>
            <td class="fw-bold text-success">{{ number_format($order->total, 2) }} ₽</td>
            <td>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-flex gap-1">
                    @csrf @method('PUT')
                    <select name="status" class="form-select form-select-sm">
                        @foreach(['pending' => '⏳ Ожидает', 'processing' => '⚙️ Обрабатывается', 'shipped' => '🚚 Отправлен', 'completed' => '✅ Завершён', 'cancelled' => '❌ Отменён'] as $val => $label)
                            <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-warning btn-sm">✔</button>
                </form>
            </td>
            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">👁</a>
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Удалить заказ #{{ $order->id }}?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑️</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $orders->links() }}
@endif
@endsection
