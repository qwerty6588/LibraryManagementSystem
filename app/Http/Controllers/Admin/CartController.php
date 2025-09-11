<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);


        $total = collect($cart)->sum(function ($book) {
            return $book['price'] * $book['quantity'];
        });

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
                'title' => $book->title,
                'price' => $book->price,
                'quantity' => $quantity,
                'image' => $book->image,
                'cover' => $book->cover,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Книга добавлена в корзину!');
    }



    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int)$request->input('quantity', 1));
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
        return redirect()->route('cart.index')->with('success', 'Корзина очищена! Через 5 секунд произойдет переход на страницу книг.');
    }


    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста!');
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
            $dbBook = Book::find($id);
            if ($dbBook && $dbBook->quantity >= $book['quantity']) {
                $dbBook->quantity -= $book['quantity'];
                $dbBook->save();
            } else {
                return redirect()->route('cart.index')
                    ->with('error', "Недостаточно экземпляров книги: {$book['title']}");
            }
        }


        session()->put([
            'purchase_total' => $total,
            'purchase_payment_method' => $validated['payment_method'],
            'purchase_quantity' => $totalQuantity,
        ]);


        session()->forget('cart');

        return redirect()->route('cart.success');
    }


    public function success()
    {
        if (!session()->has('purchase_total')) {
            return redirect()->route('cart.index')->with('error', 'Нет данных о покупке.');
        }

        $total = session('purchase_total');
        $payment_method = session('purchase_payment_method');
        $quantity = session('purchase_quantity');


        session()->forget(['purchase_total', 'purchase_payment_method', 'purchase_quantity']);

        return view('admin.pages.cart.success', compact('total', 'payment_method', 'quantity'));
    }
}
