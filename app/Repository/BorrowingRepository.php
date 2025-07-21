<?php

namespace App\Repository;

use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Collection;

class BorrowingRepository extends BaseRepository
{

    public function getModel(): string
    {
        return Borrowing::class;
    }

    public function getBorrowings(): Collection
    {
        return $this->model->all();
    }

    public function create(
        string $user_id,
        string $book_id,
        string $borrowed_at,
        string $returned_at
    ): ?Borrowing
    {
        return $this->model->create([
            'user_id' => $user_id,
            'book_id' => $book_id,
            'borrowed_at' => $borrowed_at,

            'returned_at' => $returned_at
        ]);
    }

    public function update(Borrowing $borrowing, string $user_id, string $book_id, string $borrowed_at,string $returned_at): bool
    {
        return $borrowing->update([
            'user_id' => $user_id,
            'book_id' => $book_id,
            'borrowed_at' => $borrowed_at,
            'returned_at' => $returned_at
        ]);
    }

    public function delete(Borrowing $borrowing): bool
    {
        return $borrowing->delete();
    }

    public function findById(int $id): ?Borrowing
    {
        return $this->model::find($id) ?: null;
    }
}
