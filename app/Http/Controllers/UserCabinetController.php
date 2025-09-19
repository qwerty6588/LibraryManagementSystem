<?php

namespace App\Http\Controllers;

use App\Service\OrderService;
use Illuminate\Support\Facades\Auth;

class UserCabinetController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $userId = Auth::id();
        $orders = $this->orderService->getUserOrders($userId);

        return view('site.user.orders', compact('orders'));
    }

    public function show($orderId)
    {
        $userId = Auth::id();
        $orders = $this->orderService->getUserOrders($userId);
        $order = $orders->firstWhere('id', $orderId);

        if (!$order) {
            return redirect()->route('user.orders')->with('error', 'Order not found.');
        }

        return view('site.user.order_item', compact('order'));
    }
}
