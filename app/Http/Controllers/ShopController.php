<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $products   = Product::with('category')
                              ->where('is_active', true)
                              ->paginate(12);
        $categories = Category::all();
        return view('shop.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('category')
                          ->where('slug', $slug)
                          ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->where('is_active', true)
                                  ->take(4)
                                  ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }

    public function category($slug)
    {
        $category   = Category::where('slug', $slug)->firstOrFail();
        $products   = $category->products()
                               ->where('is_active', true)
                               ->paginate(12);
        $categories = Category::all();
        return view('shop.index', compact('products', 'category', 'categories'));
    }
}
