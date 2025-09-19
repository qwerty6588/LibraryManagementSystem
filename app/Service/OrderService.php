<?php

namespace App\Service;

use App\Models\OrderItem;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository) {}

    public function createOrder(array $cart, int $userId, string $paymentMethod): void
    {
        DB::transaction(function () use ($cart, $userId, $paymentMethod) {
            $total = collect($cart)->sum(fn($b) => $b['price'] * $b['quantity']);
            $quantity = collect($cart)->sum(fn($b) => $b['quantity']);

            $order = $this->orderRepository->create([
                'user_id'        => $userId,
                'total'          => $total,
                'quantity'       => $quantity,
                'payment_method' => $paymentMethod,
                'status'         => 'pending',
            ]);

            foreach ($cart as $bookId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id'  => $bookId,
                    'quantity' => $item['quantity'],
                    'price'    => $item['price'],
                ]);
            }
        });
    }

    public function updateStatus(int $id, string $status) {
        return $this->orderRepository->updateStatus($id, $status);
    }

    public function getOrdersForAdmin() {
        return $this->orderRepository->getAll();
    }

    public function getUserOrders(int $userId) {
        return $this->orderRepository->getByUser($userId);
    }

    public function index()
    {
        $orders = $this->getOrdersForAdmin();

        return $orders->map(function ($order) {
            return [
                'id'             => $order->id,
                'user_name'      => $order->user->name ?? 'Unknown',
                'user_email'     => $order->user->email ?? '-',
                'items'          => $order->items->map(fn($i) => [
                    'title'    => $i->book->title ?? 'Unknown',
                    'quantity' => $i->quantity,
                ]),
                'quantity'       => $order->items->sum('quantity'),
                'total'          => $order->items->sum(fn($i) => $i->price * $i->quantity),
                'payment_method' => $order->payment_method,
                'date'           => $order->created_at->format('Y-m-d H:i'),
                'status'         => $order->status,
            ];
        });
    }

}
