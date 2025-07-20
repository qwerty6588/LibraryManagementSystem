<?php

namespace App\Service;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Repository\BookRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class BookService
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @throws Exception
     */
    public function getBooks(): Collection
    {
        $books = $this->bookRepository->getBooks();
        if (empty($books) || $books->count() === 0) {
            throw new Exception('Books not found');
        }
        return $books;
    }

    /**
     * @throws Exception
     */
    public function createBook(array $data): Book
    {
        $books = $this->getBooks();
        foreach ($books as $book) {
            if ($book->title === $data['title']) {
                throw new Exception('Book already exists');
            }
        }

        $author = Author::firstOrCreate(['name' => $data['author_name']]);
        $category = Category::firstOrCreate(['name' => $data['category_name']]);

        $bookData = [
            'title' => $data['title'],
            'author_id' => $author->id,
            'category_id' => $category->id,
            'description' => $data['description'] ?? null,
            'published_year' => $data['published_year'],
        ];

        $result = $this->bookRepository->create($bookData);

        if (!$result) {
            throw new Exception('Book not created');
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function updateBook(int $id, array $data): Book
    {
        $book = $this->findBookById($id);

        $existingBooks = $this->getBooks();
        foreach ($existingBooks as $existing) {
            if ($existing->title === $data['title'] && $existing->id !== $id) {
                throw new Exception('Another book with this title already exists');
            }
        }

        $updated = $this->bookRepository->update($book, $data);

        if (!$updated) {
            throw new Exception('Book not updated');
        }

        return $this->findBookById($id);
    }

    /**
     * @throws Exception
     */
    public function deleteBook(int $id): bool
    {
        $book = $this->findBookById($id);

        $deleted = $this->bookRepository->delete($book);
        if (!$deleted) {
            throw new Exception('Book not deleted');
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function findBookById(int $id): Book
    {
        $book = $this->bookRepository->findById($id);
        if (!$book) {
            throw new Exception('Book not found');
        }
        return $book;
    }
}
