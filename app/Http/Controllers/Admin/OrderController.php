<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->index();
        return view('site.cart.purchases', compact('orders'));

    }

    public function updateStatus($id)
    {
        request()->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $this->orderService->updateStatus($id, request('status'));

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated!');
    }
}
