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
    protected BorrowingService $borrowingService;
    protected UserService $userService;
    protected BookService $bookService;

    public function __construct(
        BorrowingService $borrowingService,
        UserService $userService,
        BookService $bookService
    ) {
        $this->borrowingService = $borrowingService;
        $this->userService = $userService;
        $this->bookService = $bookService;
    }


    public function index(): View
    {
        try {
            $borrowings = $this->borrowingService->getBorrowings();
            return view('admin.pages.borrowings.index', compact('borrowings'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function create(): View
    {
        try {
            $users = User::all();
            $books = Book::all();
            return view('admin.pages.borrowings.create', compact('users', 'books'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function store(BorrowingRequest $request): View|RedirectResponse
    {
        try {
            $this->borrowingService->createBorrowing($request->validated());
            return redirect()->route('admin.users.index', [
                'borrowings' => $this->borrowingService->getBorrowings()
            ])->with('success', 'Borrowing created successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function edit(int $id): View
    {
        try {
            $borrowing = $this->borrowingService->findBorrowingById($id);
            $users = $this->userService->getUsers();
            $books = $this->bookService->getBooks();

            return view('admin.pages.borrowings.edit', compact('borrowing', 'users', 'books'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function update(BorrowingRequest $request, int $id): View|RedirectResponse
    {
        try {

            $this->borrowingService->updateBorrowing($id, $request->validated());
            return redirect()->route('admin.borrowings.index', [
                'borrowings' => $this->borrowingService->getBorrowings()
            ])->with('success', 'Borrowing updated successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function destroy(int $id): View|RedirectResponse
    {
        try {
            $this->borrowingService->deleteBorrowing($id);
            return redirect()->route('admin.borrowings.index', [
                'borrowings' => $this->borrowingService->getBorrowings()
            ])->with('success', 'User deleted successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

}
