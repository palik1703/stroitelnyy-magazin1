@extends('layouts.app')
@section('title', $product->name)
@section('content')

{{-- Навигация (хлебные крошки) --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">🏠 Главная</a></li>
        @if($product->category)
            <li class="breadcrumb-item">
                <a href="{{ route('category', $product->category->slug) }}">
                    {{ $product->category->name }}
                </a>
            </li>
        @endif
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row g-5">
    {{-- Фото товара --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="img-fluid w-100"
                     style="max-height:420px;object-fit:cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center"
                     style="height:420px;font-size:7rem;">🔧</div>
            @endif
        </div>
    </div>

    {{-- Информация о товаре --}}
    <div class="col-md-7">
        <p class="text-muted mb-1">{{ $product->category->name ?? '' }}</p>
        <h1 class="fw-bold mb-3">{{ $product->name }}</h1>

        {{-- Цена --}}
        <div class="mb-3">
            <span class="display-6 fw-bold text-success">{{ number_format($product->price, 2) }} ₽</span>
        </div>

        {{-- Наличие --}}
        <div class="mb-3">
            @if($product->stock > 0)
                <span class="badge bg-success fs-6 px-3 py-2">✅ В наличии: {{ $product->stock }} шт.</span>
            @else
                <span class="badge bg-danger fs-6 px-3 py-2">❌ Нет в наличии</span>
            @endif
        </div>

        {{-- Описание --}}
        @if($product->description)
        <div class="mb-4">
            <h5 class="fw-bold">Описание</h5>
            <p class="text-muted lh-lg">{{ $product->description }}</p>
        </div>
        @endif

        {{-- Характеристики --}}
        <div class="card bg-light border-0 mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">📋 Характеристики</h6>
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted w-50">Категория</td>
                        <td class="fw-semibold">{{ $product->category->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Артикул</td>
                        <td class="fw-semibold">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Наличие</td>
                        <td class="fw-semibold">{{ $product->stock > 0 ? $product->stock . ' шт.' : 'Нет в наличии' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Кнопки --}}
        <div class="d-flex gap-3">
            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                    @csrf
                    <button class="btn btn-primary btn-lg w-100">
                        🛒 Добавить в корзину
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-lg flex-grow-1" disabled>Нет в наличии</button>
            @endif
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">← Назад</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
    </div>
</div>

{{-- Похожие товары --}}
@if($relatedProducts->count() > 0)
<div class="mt-5">
    <h3 class="fw-bold mb-4">🔎 Похожие товары</h3>
    <div class="row row-cols-1 row-cols-md-4 g-3">
        @foreach($relatedProducts as $related)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <a href="{{ route('product.show', $related->slug) }}">
                    @if($related->image)
                        <img src="{{ asset('storage/'.$related->image) }}"
                             class="card-img-top" style="height:150px;object-fit:cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:150px;font-size:2.5rem;">🔧</div>
                    @endif
                </a>
                <div class="card-body">
                    <p class="card-title small fw-bold mb-1">{{ $related->name }}</p>
                    <p class="text-success fw-bold mb-0">{{ number_format($related->price, 2) }} ₽</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection
