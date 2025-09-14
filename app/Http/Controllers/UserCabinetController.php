<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserCabinetController extends Controller
{
    public function index()
    {
        $userId = Auth::id() ?? 'guest';
        $purchases = session()->get('purchases', []);
        $orders = $purchases[$userId] ?? [];

        return view('site.user.orders', compact('orders'));
    }

    public function show($orderId)
    {
        $userId = Auth::id() ?? 'guest';
        $purchases = session()->get('purchases', []);
        $orders = $purchases[$userId] ?? [];

        $order = collect($orders)->firstWhere('id', $orderId);

        if (!$order) {
            return redirect()->route('user.orders')->with('error', 'Order not found.');
        }

        return view('site.user.order_item', compact('order'));
    }
}
