@extends('layouts.app')
@section('title', 'Категории')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📂 Категории</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">+ Добавить</button>
</div>
<table class="table table-bordered">
    <thead class="table-dark">
        <tr><th>#</th><th>Название</th><th>Slug</th><th>Товаров</th><th>Действия</th></tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->products_count ?? 0 }}</td>
            <td>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Удалить категорию?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑️</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Категории не добавлены</td></tr>
        @endforelse
    </tbody>
</table>

{{-- Модальное окно добавления --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Новая категория</h5></div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug (URL-имя, латиницей)</label>
                        <input type="text" name="slug" class="form-control" required placeholder="napr-dreli">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
