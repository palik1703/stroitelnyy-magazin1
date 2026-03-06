<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Статус заказа обновлён!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
                         ->with('success', 'Заказ удалён!');
    }

    public function create() { return redirect()->route('admin.orders.index'); }
    public function store(Request $request) { return redirect()->route('admin.orders.index'); }
    public function edit(Order $order) { return redirect()->route('admin.orders.index'); }
}
