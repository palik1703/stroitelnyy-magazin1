@extends('layouts.app')
@section('title', 'Админ-панель')
@section('content')
<h1 class="mb-4">📊 Панель администратора</h1>

<div class="row g-4">

    {{-- Товары --}}
    <div class="col-md-4">
        <div class="card text-white shadow h-100" style="background-color:#0d6efd;">
            <div class="card-body text-center py-4">
                <h2 class="display-4 fw-bold">{{ $totalProducts }}</h2>
                <p class="fs-5 mb-3">Товаров</p>
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-light fw-semibold w-100">
                    📦 Управление товарами
                </a>
            </div>
        </div>
    </div>

    {{-- Заказы --}}
    <div class="col-md-4">
        <div class="card text-white shadow h-100" style="background-color:#198754;">
            <div class="card-body text-center py-4">
                <h2 class="display-4 fw-bold">{{ $totalOrders }}</h2>
                <p class="fs-5 mb-3">Заказов</p>
                <a href="{{ route('admin.orders.index') }}"
                   class="btn btn-light fw-semibold w-100">
                    🧾 Управление заказами
                </a>
            </div>
        </div>
    </div>

    {{-- Категории --}}
    <div class="col-md-4">
        <div class="card text-white shadow h-100" style="background-color:#ffc107;color:#000 !important;">
            <div class="card-body text-center py-4" style="color:#000;">
                <h2 class="display-4 fw-bold" style="color:#000;">{{ $totalCategories }}</h2>
                <p class="fs-5 mb-3" style="color:#000;">Категорий</p>
                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-dark fw-semibold w-100">
                    📂 Управление категориями
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
