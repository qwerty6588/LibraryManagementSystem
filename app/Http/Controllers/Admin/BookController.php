<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Service\BookService;
use App\Service\CategoryService;
use App\Service\AuthorService;
use Illuminate\View\View;
use Throwable;

class BookController extends Controller
{
    private BookService $bookService;
    private AuthorService $authorService;
    private CategoryService $categoryService;
    public function __construct(BookService $bookService, AuthorService $authorService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }
    public function index(): View
    {
        try {
            $books = $this->bookService->getBooks();
            return view('admin.pages.books.index', compact('books'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function create()
    {
        try {
            $authors = $this->authorService->getAuthors();
            $categories = $this->categoryService->getCategories();
            return view('admin.pages.books.create', compact('authors', 'categories'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function store(BookRequest $request)
    {
        try {
            $this->bookService->createBook($request->validated());
            $book = $this->bookService->getBooks();
            return view('admin.pages.books.index' ,[
                'books' => $book
            ])->with('success', 'Book created successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function show($id)
    {

    }

    public function edit(int $id)
    {
        try {
            $book = $this->bookService->findBookById($id);
            return view('admin.pages.books.edit', compact('book'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function update(BookRequest $request, int $id)
    {
        try {
            $this->bookService->updateBook($id, $request->validated());
            $books = $this->bookService->getBooks();
            return view('admin.pages.books.index', [
                'books' => $books,
                'success' => 'Book updated successfully',
            ]);
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function destroy(int $id)
    {
        try {
            $this->bookService->deleteBook($id);
            $books = $this->bookService->getBooks();
            return view('admin.pages.books.index', [
                'books' => $books,
                'success' => 'Book deleted successfully',
            ]);
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }
}
