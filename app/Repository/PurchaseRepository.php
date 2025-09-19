<?php

namespace App\Repository;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Collection;

class PurchaseRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Purchase::class;
    }

    public function getPurchases(): Collection
    {
        return $this->model->with(['user', 'book'])->get();
    }

    public function create(
        int $user_id,
        int $book_id,
        int $quantity,
        string $purchased_at
    ): ?Purchase {
        return $this->model->create([
            'user_id'      => $user_id,
            'book_id'      => $book_id,
            'quantity'     => $quantity,
            'purchased_at' => $purchased_at,
        ]);
    }

    public function update(
        Purchase $purchase,
        int $user_id,
        int $book_id,
        int $quantity,
        string $purchased_at
    ): bool {
        return $purchase->update([
            'user_id'      => $user_id,
            'book_id'      => $book_id,
            'quantity'     => $quantity,
            'purchased_at' => $purchased_at,
        ]);
    }

    public function delete(Purchase $purchase): bool
    {
        return $purchase->delete();
    }

    public function findById(int $id): ?Purchase
    {
        return $this->model->with(['user', 'book'])->find($id);
    }
}
