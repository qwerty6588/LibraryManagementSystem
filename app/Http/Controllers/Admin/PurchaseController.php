<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Service\BookService;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    /** @var BookService $bookService */
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     *
     */
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
}
