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

    public function create(
        string $title,
        string $author_id,
        string $category_id,
        string $quantity,
    ):? Book
    {
        return $this->model->create([
            'title' => $title,
            'author_id' => $author_id,
            'category_id' => $category_id,
            'quantity' => $quantity
        ]);
    }

    public function update(Book $book, string $title, string $author_id, string $category_id, string $quantity): bool
    {
        return $book->update([
            'title' => $title,
            'author_id' => $author_id,
            'category_id' => $category_id,
            'quantity' => $quantity
        ]);
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }
}
