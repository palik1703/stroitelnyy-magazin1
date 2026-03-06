<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalOrders    = Order::count();
        $totalCategories = Category::count();
        $recentOrders   = Order::latest()->take(5)->get();
        return view('admin.dashboard', compact(
            'totalProducts','totalOrders','totalCategories','recentOrders'
        ));
    }
}
