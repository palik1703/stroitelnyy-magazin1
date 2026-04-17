@extends('layouts.app')
@section('title', 'Каталог')
@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="fw-bold">🔨 Строительные инструменты</h1>
    <span class="text-muted">Найдено: {{ $products->total() }} товаров</span>
</div>

<div class="mb-4 d-flex flex-wrap gap-2">
    <a href="{{ route('home') }}"
        class="btn btn-sm {{ !isset($category) ? 'btn-dark' : 'btn-outline-dark' }}">
        Все товары
    </a>
    @foreach($categories ?? [] as $cat)
    <a href="{{ route('category', $cat->slug) }}"
        class="btn btn-sm {{ isset($category) && $category->id === $cat->id ? 'btn-dark' : 'btn-outline-dark' }}">
        {{ $cat->name }}
    </a>
    @endforeach
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($products as $product)
    <div class="col">
        <div class="card h-100 shadow-sm border-0 product-card">
            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                @if($product->image)
                <<img src="{{ asset($product->image) }}"
                    class="card-img-top"
                    style="height:220px;object-fit:cover;">
                    @else
                    <div class="bg-light d-flex align-items-center justify-content-center"
                        style="height:220px;font-size:4rem;">🔧</div>
                    @endif
            </a>
            <div class="card-body d-flex flex-column">
                <p class="text-muted small mb-1">{{ $product->category->name ?? '' }}</p>
                <h6 class="card-title fw-bold">
                    <a href="{{ route('product.show', $product->slug) }}"
                        class="text-dark text-decoration-none">
                        {{ $product->name }}
                    </a>
                </h6>
                @if($product->description)
                <p class="text-muted small description-clamp">
                    {{ $product->description }}
                </p>
                @endif
                <div class="mt-auto">
                    <p class="fw-bold text-success fs-5 mb-1">{{ number_format($product->price, 2) }} ₽</p>
                    @if($product->stock > 0)
                    <span class="badge bg-success mb-2">✅ В наличии: {{ $product->stock }} шт.</span>
                    @else
                    <span class="badge bg-danger mb-2">❌ Нет в наличии</span>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3">
                <a href="{{ route('product.show', $product->slug) }}"
                    class="btn btn-outline-secondary btn-sm flex-grow-1">Подробнее</a>
                @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-sm">🛒</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-warning">Товары не найдены.</div>
    </div>
    @endforelse
</div>

@if($products->lastPage() > 1)
<div class="d-flex justify-content-center mt-5">
    <nav>
        <ul class="pagination pagination-lg">
            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() ?? '#' }}">← Назад</a>
            </li>
            @for($page = 1; $page <= $products->lastPage(); $page++)
                <li class="page-item {{ $products->currentPage() === $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $products->url($page) }}">{{ $page }}</a>
                </li>
                @endfor
                <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $products->nextPageUrl() ?? '#' }}">Вперёд →</a>
                </li>
        </ul>
    </nav>
</div>
@endif

<style>
    .product-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 12px;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .description-clamp {
        overflow: hidden;
        max-height: 3em;
        line-height: 1.5em;
    }
</style>

@endsection