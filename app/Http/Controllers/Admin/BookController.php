<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Category;
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

    public function create(): View
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

    public function edit($id)
    {
        $book = $this->bookService->findBookById($id);
        $authors = $this->authorService->getAuthors();
        $categories = $this->categoryService->getCategories();

        return view('admin.pages.books.edit', compact('book', 'authors', 'categories'));
    }




    public function update(BookRequest $request, $id)
    {
        $book = $this->bookService->findBookById($id);

        $author = Author::firstOrCreate(['name' => $request->input('author_name')]);

        $category = Category::firstOrCreate(['name' => $request->input('category_name')]);


        $this->bookService->updateBook($id, [
            'title' => $request->input('title'),
            'author_id' => $author->id,
            'category_id' => $category->id,
            'description' => $request->input('description'),
            'published_year' => $request->input('published_year'),
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена');
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
