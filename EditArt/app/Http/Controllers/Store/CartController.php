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
}
