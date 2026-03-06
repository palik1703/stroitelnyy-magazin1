@extends('layouts.app')
@section('title', 'Редактировать товар')
@section('content')
<h1 class="mb-4">✏️ Редактировать: {{ $product->name }}</h1>
<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Название *</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Категория *</label>
        <select name="category_id" class="form-select" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Цена (₽) *</label>
            <input type="number" name="price" class="form-control" step="0.01" required value="{{ old('price', $product->price) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Количество на складе *</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Новое фото (оставь пустым чтобы не менять)</label>
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="d-block mb-2" style="height:80px;">
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-warning btn-lg">Обновить</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">Отмена</a>
</form>
@endsection
