<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
{
    $categories = Category::withCount('products')->get();
    return view('admin.categories.index', compact('categories'));
}

public function store(Request $request)
{
    $request->validate(['name' => 'required', 'slug' => 'required|unique:categories']);
    Category::create($request->only('name', 'slug'));
    return redirect()->back()->with('success', 'Категория добавлена!');
}

public function destroy(Category $category)
{
    $category->delete();
    return redirect()->back()->with('success', 'Категория удалена!');
}

}
