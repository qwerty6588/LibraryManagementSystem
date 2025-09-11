<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class PurchaseController extends Controller
{
    public function index(): View
    {
        $purchases = Purchase::with('items.book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('admin.pages.purchases.index', compact('purchases'));
    }

    public function checkout(): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($cart as $bookId => $item) {
            PurchaseItem::query()->create([
                'purchase_id' => $purchase->id,
                'book_id'     => $bookId,
                'quantity'    => $item['quantity'],
                'price'       => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Заказ успешно оформлен!');
    }

    public function show(int $id): View
    {
        $purchase = Purchase::with('items.book')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('admin.pages.purchases.show', compact('purchase'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $purchase = Purchase::where('user_id', Auth::id())->findOrFail($id);
        $purchase->delete();

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Заказ удалён');
    }
}
