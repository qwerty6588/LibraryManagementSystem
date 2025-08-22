<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowingRequest;
use App\Models\Book;
use App\Models\User;
use App\Service\BorrowingService;
use App\Service\BookService;
use App\Service\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class BorrowingController extends Controller
{
    private BorrowingService $borrowingService;
    private UserService $userService;
    private BookService $bookService;

    public function __construct(
        BorrowingService $borrowingService,
        UserService $userService,
        BookService $bookService
    ) {
        $this->borrowingService = $borrowingService;
        $this->userService = $userService;
        $this->bookService = $bookService;
    }

    public function index()
    {
            $borrowings = $this->borrowingService->getBorrowings();
            return view('admin.pages.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
            $users = User::all();
            $books = Book::all();
            return view('admin.pages.borrowings.create', compact('users', 'books'));
    }

    public function store(BorrowingRequest $request):RedirectResponse
    {

            $this->borrowingService->createBorrowing($request->validated());
            return redirect()->route('admin.users.index', [
                'borrowings' => $this->borrowingService->getBorrowings()
            ])->with('success', 'Borrowing created successfully');

    }


    public function edit(int $id)
    {

            $borrowing = $this->borrowingService->findBorrowingById($id);
            $users = $this->userService->getUsers();
            $books = $this->bookService->getBooks();

            return view('admin.pages.borrowings.edit', compact('borrowing', 'users', 'books'));

    }

    public function update(BorrowingRequest $request, int $id):RedirectResponse
    {
            $this->borrowingService->updateBorrowing($id, $request->validated());
            return redirect()->route('admin.borrowings.index', [
                'borrowings' => $this->borrowingService->getBorrowings()
            ])->with('success', 'Borrowing updated successfully');
    }

    public function destroy(int $id):RedirectResponse
    {

            $this->borrowingService->deleteBorrowing($id);
            return redirect()->route('admin.borrowings.index', [
                'borrowings' => $this->borrowingService->getBorrowings()
            ])->with('success', 'User deleted successfully');
    }

}
