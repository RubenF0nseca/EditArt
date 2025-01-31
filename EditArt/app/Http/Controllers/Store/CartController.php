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

        return view('cart.cart', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function removeFromCart(string $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removido do carrinho com sucesso!');
    }

    public function updateQuantity(Request $request)
    {
        $bookId = $request->input('book_id');
        $newQuantity = (int)$request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] = max(1, min($newQuantity, 50)); // Garante que está entre 1 e 50
        }

        session()->put('cart', $cart);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['book']->price * $item['quantity'];
        }
        $shipping = 2.00;
        $total = $subtotal + $shipping;

        return response()->json([
            'success' => true,
            'quantity' => $cart[$bookId]['quantity'],
            'lineTotal' => number_format($cart[$bookId]['quantity'] * $cart[$bookId]['book']->price, 2),
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($total, 2)
        ]);
    }


}
