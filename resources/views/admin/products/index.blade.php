@extends('layouts.app')
@section('title', 'Товары')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📦 Товары</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Добавить товар</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Название</th><th>Категория</th><th>Цена</th><th>Остаток</th><th>Действия</th></tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '—' }}</td>
            <td>{{ number_format($product->price, 2) }} ₽</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">✏️</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑️</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Товары не добавлены</td></tr>
        @endforelse
    </tbody>
</table>
{{ $products->links() }}
@endsection
