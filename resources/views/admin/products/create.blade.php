@extends('layouts.app')
@section('title', 'Добавить товар')
@section('content')
<h1 class="mb-4">+ Добавить товар</h1>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Название *</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Категория *</label>
        <select name="category_id" class="form-select" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Цена (₽) *</label>
            <input type="number" name="price" class="form-control" step="0.01" required value="{{ old('price') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Количество на складе *</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock', 0) }}">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Фото товара</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
            <label class="form-check-label" for="is_active">
                Активен (отображать на сайте)
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-lg">Сохранить</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">Отмена</a>
</form>
@endsection
