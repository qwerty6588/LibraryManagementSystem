<?php

namespace App\Repository;

use App\Models\Order;

class OrderRepository
{
    public function create(array $data): Order {
        return Order::create($data);
    }

    public function updateStatus(int $id, string $status): ?Order {
        $order = Order::find($id);
        if ($order) {
            $order->update(['status' => $status]);
        }
        return $order;
    }

    public function getAll() {
        return Order::with(['user', 'items.book'])->get();
    }

    public function getByUser(int $userId) {
        return Order::with('items.book')->where('user_id', $userId)->get();
    }
}
