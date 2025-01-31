<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Total COM IVA (já está incluso nos preços)
        $total_com_iva = 0;
        foreach ($cart as $item) {
            $total_com_iva += $item['book']->price * $item['quantity'];
        }

        // Cálculo do valor SEM IVA (6%)
        $total_sem_iva = $total_com_iva / 1.06;
        $iva = $total_com_iva - $total_sem_iva;

        $shipping = 2.00;
        $total_pagar = $total_com_iva + $shipping;

        return view('cart.cart', compact(
            'cart',
            'total_sem_iva',
            'iva',
            'shipping',
            'total_pagar'
        ));
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

        $total_com_iva = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['book']->price * $item['quantity']);
        }, 0);

        $total_sem_iva = $total_com_iva / 1.06;
        $iva = $total_com_iva - $total_sem_iva;
        $shipping = 2.00;
        $total_pagar = $total_com_iva + $shipping;

        return response()->json([
            'success' => true,
            'quantity' => $cart[$bookId]['quantity'],
            'lineTotal' => number_format($cart[$bookId]['quantity'] * $cart[$bookId]['book']->price, 2),
            'total_sem_iva' => number_format($total_sem_iva, 2),
            'iva' => number_format($iva, 2),
            'total_pagar' => number_format($total_pagar, 2)
        ]);
    }

    public function mergeCart()
    {
        if (auth()->check()) {
            $userId = Auth::id();
            $cart = session()->get('cart', []);
            foreach($cart as $bookId => $item) {
                $exist = Cart::where('user_id', $userId)->where('book_id', $bookId)->first();
            }

        }
    }


}
