<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Book;
use App\Models\Purchase;
use App\Models\User;
use App\Service\PurchaseService;
use App\Service\BookService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    /** @var PurchaseService $purchaseService */
    private PurchaseService $purchaseService;

    /** @var UserService $userService */
    private UserService $userService;

    /** @var BookService $bookService */
    private BookService $bookService;

    public function __construct(
        PurchaseService $purchaseService,
        UserService $userService,
        BookService $bookService
    ) {
        $this->purchaseService = $purchaseService;
        $this->userService = $userService;
        $this->bookService = $bookService;
    }

    public function create($id)
    {
        $book = $this->bookService->findBookById($id);
        return view('admin.pages.books.purchase.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'cvv'      => 'required|digits_between:3,4',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = null;
        for ($i = 0; $i < $validated['quantity']; $i++) {
            $book = $this->bookService->purchaseBook($id);
        }

        $purchase = Purchase::create([
            'user_id'  => Auth::id(),
            'book_id'  => $book->id,
            'quantity' => $validated['quantity'],
            'total'    => $book->price * $validated['quantity'],
        ]);

        return redirect()->route('purchase.success')->with('purchase_data', [
            'book'     => $book->title,
            'quantity' => $purchase->quantity,
            'total'    => $purchase->total,
            'payment_method' => 'Card',
        ]);
    }

    /**
     * Show purchase success page.
     *
     * @
     */
    public function success()
    {
        $data = session('purchase_data');

        if (!$data) {
            return redirect()->route('admin.books.index')->with('error', 'Нет данных о покупке.');
        }

        return view('admin.pages.books.purchase.success', $data);
    }

    public function index()
    {
        $purchases = $this->purchaseService->getPurchases();
        return view('admin.pages.purchases.index', compact('purchases'));
    }


    public function edit(int $id)
    {
        $purchase = $this->purchaseService->findPurchaseById($id);
        $users = $this->userService->getUsers();
        $books = $this->bookService->getBooks();

        return view('admin.pages.purchases.edit', compact('purchase', 'users', 'books'));
    }

    public function update(PurchaseRequest $request, int $id): RedirectResponse
    {
        $this->purchaseService->updatePurchase($id, $request->validated());
        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->purchaseService->deletePurchase($id);
        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase deleted successfully');
    }
}
