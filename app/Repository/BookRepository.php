<?php

namespace App\Repository;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Book::class;
    }

    public function getBooks(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): ?Book
    {
        return $this->model::find($id) ?: null;
    }

    public function create(array $data): ?Book
    {
        return $this->model->create($data);
    }

    public function update(Book $book, array $data): bool
    {
        return $book->update($data);
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }
}
