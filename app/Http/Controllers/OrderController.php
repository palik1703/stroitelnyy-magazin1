<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::with('items.product')
                   ->where('user_id', Auth::id())
                   ->latest()
                   ->get();
    return view('orders.index', compact('orders'));
}

    public function create()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('error', 'Корзина пуста!');
        }
        return view('orders.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone'   => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'phone'   => $request->phone,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')
                         ->with('success', 'Заказ #' . $order->id . ' успешно оформлен!');
    }
    
}
