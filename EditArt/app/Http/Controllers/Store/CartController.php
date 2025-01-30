<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(string $id)
    {
        $book = Book::findOrfail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'quantity' => 1,
                'book' => $book
            ];
        }
        session()->put('cart', $cart);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'cartCount' => count($cart),
                'message' => 'Book added to cart successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Book added to cart successfully!');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['book']->price * $item['quantity'];
        }
        $shipping = 2.00;
        $total = $subtotal + $shipping;

        return view('client.cart', compact('cart', 'subtotal', 'shipping', 'total'));
    }
}
