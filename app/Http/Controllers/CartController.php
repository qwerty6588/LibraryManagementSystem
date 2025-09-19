<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService ;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($book) => $book['price'] * $book['quantity']);

        return view('site.cart.index', compact('cart', 'total'));
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
            'payment_method' => 'required|string',
        ]);

        $this->orderService->createOrder(
            $cart,
            Auth::id() ?? null,
            $validated['payment_method']
        );

        session()->forget('cart');

        return redirect()->route('cart.success');
    }

    public function success()
    {
        return view('site.cart.success');
    }
}
