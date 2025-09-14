<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Service\BookService;
use App\Service\CategoryService;
use App\Service\AuthorService;
use Throwable;

/**
 * @property int $id
 * @property array $title
 * @property array $description
 * @property int $author_id
 * @property int $category_id
 * @property int $quantity
 * @property int|null $published_year
 * @property string|null $image
 * @property string|null $price
 * @property string|null $cover
 * @property \App\Models\Author $author
 * @property \App\Models\Category $category
 */
class BookController extends Controller
{
    /** @var BookService $bookService */
    private BookService $bookService;

    /** @var AuthorService $authorService */
    private AuthorService $authorService;

    /** @var CategoryService $categoryService */
    private CategoryService $categoryService;

    public function __construct(BookService $bookService, AuthorService $authorService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }


    public function index()
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
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('books', 'public');
                $data['image'] = $path;
            }

            $this->bookService->createBook($data);

            $books = $this->bookService->getBooks();

            return view('admin.pages.books.index', [
                'books' => $books
            ])->with('success', 'Book created successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }



    /**
     * Show all books with covers.
     */
    public function show()
    {
        try {
            /** @var \Illuminate\Database\Eloquent\Collection<int, Book> $books */
            $books = Book::with(['author', 'category'])->get();

            $customCovers = [
                '1984' => '1984.jpg',
                'Harry Potter' => 'harry_potter.jpg',
                'The Shining' => 'the_shining.jpg',
                'I, Robot' => 'i_robot.jpg',
                'Pride and Prejudice' => 'pride_prejudice.jpg',
                ];

            /** @var Book $book */
            foreach ($books as $book) {

                if (empty($book->cover) && array_key_exists($book->title, $customCovers)) {
                    $book->cover = $customCovers[$book->title];
                }
            }
            return view('admin.pages.books.show', compact('books'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function edit($id)
    {
        try {
            $book = $this->bookService->findBookById($id);
            $authors = $this->authorService->getAuthors();
            $categories = $this->categoryService->getCategories();

            return view('admin.pages.books.edit',
                compact('book', 'authors', 'categories'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function update(BookRequest $request, $id)
    {
        try {
            $book = $this->bookService->findBookById($id);

            $data = $request->validated();


            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('books', 'public');
                $data['image'] = $path;
            } else {
                $data['image'] = $book->image;
            }

            $this->bookService->updateBook($id, [
                'title'          => $data['title'],
                'author_id'      => $request->input('author_id'),
                'category_id'    => $request->input('category_id'),
                'description'    => $data['description'],
                'published_year' => $data['published_year'],
                'price'          => $data['price'],
                'quantity'       => $data['quantity'],
                'image'          => $data['image'],
                ]);

            return redirect()->route('admin.books.index')
                ->with('success', 'Книга успешно обновлена');
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
