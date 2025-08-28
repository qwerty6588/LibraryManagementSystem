<?php

namespace App\Service;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Purchase;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class BookService
{
    protected BookRepository $bookRepository;
    protected AuthorRepository $authorRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Collection<int, Book>
     * @throws Exception
     */
    public function getBooks(): Collection
    {
        $books = $this->bookRepository->getBooks();
        if ($books->isEmpty()) {
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

        $author = $this->authorRepository->findByName($data['author_id']);
        if (!$author) {
            throw new Exception('Author not found');
        }

        $category = $this->categoryRepository->findByName($data['category_id']);
        if (!$category) {
            throw new Exception('Category not found');
        }

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

    /**
     * @throws Exception
     */
    public function purchaseBook(int $id): Book
    {
        $book = $this->findBookById($id);

        if ($book->quantity < 1) {
            throw new Exception('This book is out of stock');
        }

        $book->quantity = $book->quantity - 1;

        $updated = $this->bookRepository->update($book, ['quantity' => $book->quantity]);

        if (!$updated) {
            throw new Exception('Purchase failed');
        }

        return $book;
    }
}
