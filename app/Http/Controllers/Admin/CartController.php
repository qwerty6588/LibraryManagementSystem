<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(fn($book) => $book['price'] * $book['quantity']);

        return view('admin.pages.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = (int) $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'title'    => $book->title,
                'price'    => $book->price,
                'quantity' => $quantity,
                'image'    => $book->image,
                'cover'    => $book->cover,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Book added to cart');
    }

    public function purchases()
    {
        $purchases = session()->get('purchases', []);

        $orders = [];
        foreach ($purchases as $userId => $userOrders) {
            $user = User::query()->find($userId);
            foreach ($userOrders as $order) {
                $orders[] = [
                    'id'             => $order['id'],
                    'user'           => $user?->name ?? '—',
                    'user_email'     => $user?->email ?? '—',
                    'items'          => $order['items'],
                    'total'          => $order['total'],
                    'quantity'       => $order['quantity'],
                    'payment_method' => $order['payment_method'],
                    'date'           => now()->format('d-m-Y'),
                    'status'         => $order['status'],
                ];
            }
        }

        return view('admin.pages.cart.purchases', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $purchases = session()->get('purchases', []);

        foreach ($purchases as $userId => &$orders) {
            foreach ($orders as &$order) {
                if ($order['id'] === $id) {
                    $order['status'] = $validated['status'];
                    break 2;
                }
            }
        }

        session()->put('purchases', $purchases);

        return redirect()->route('admin.purchases')->with('success', 'Order status updated!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->input('quantity', 1));
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'The cart is cleared!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'The cart is empty!');
        }

        $validated = $request->validate([
            'cvv'            => 'required|digits_between:3,4',
            'payment_method' => 'required|string',
        ]);

        $total = 0;
        $totalQuantity = 0;

        foreach ($cart as $id => $book) {
            $total += $book['price'] * $book['quantity'];
            $totalQuantity += $book['quantity'];

            /** @var Book|null $dbBook */
            $dbBook = Book::query()->find($id);
            if ($dbBook && $dbBook->quantity >= $book['quantity']) {
                $dbBook->quantity -= $book['quantity'];
                $dbBook->save();
            } else {
                return redirect()->route('cart.index')
                    ->with('error', "Not enough copies of the book: {$book['title']}");
            }
        }

        $purchases = session()->get('purchases', []);
        $userId = auth()->id() ?? 'guest';

        $purchases[$userId][] = [
            'id'             => uniqid('order_'),
            'items'          => $cart,
            'total'          => $total,
            'quantity'       => $totalQuantity,
            'payment_method' => $validated['payment_method'],
            'status'         => 'pending',
            'date'           => now()->format('d-m-Y H:i'),
        ];

        session()->put('purchases', $purchases);

        session()->put('purchase_total', $total);
        session()->put('purchase_payment_method', $validated['payment_method']);
        session()->put('purchase_quantity', $totalQuantity);

        session()->forget('cart');

        return redirect()->route('cart.success');
    }

    public function success()
    {
        if (!session()->has('purchase_total')) {
            return redirect()->route('cart.index')->with('error', 'No purchase data available.');
        }

        $total          = session('purchase_total');
        $payment_method = session('purchase_payment_method');
        $quantity       = session('purchase_quantity');

        session()->forget(['purchase_total', 'purchase_payment_method', 'purchase_quantity']);

        return view('admin.pages.cart.success', compact('total', 'payment_method', 'quantity'));
    }
}
