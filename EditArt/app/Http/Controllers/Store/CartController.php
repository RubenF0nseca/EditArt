<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(string $id)
    {
        $book = Book::findOrFail($id);

        if (auth()->check()) {
            $cartItem = Cart::firstOrNew([
                'user_id' => auth()->id(),
                'book_id' => $book->id
            ]);

            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);
            $cart[$id] = [
                'quantity' => ($cart[$id]['quantity'] ?? 0) + 1,
                'book' => $book
            ];
            session()->put('cart', $cart);
        }

        return $this->handleResponse();
    }

    public function showCart()
    {
        if (auth()->check()) {
            $cartItems = Cart::with('book')->where('user_id', auth()->id())->get();
            $cart = $cartItems->mapWithKeys(function ($item) {
                return [
                    $item->book_id => [
                        'quantity' => $item->quantity,
                        'book' => $item->book
                    ]
                ];
            })->toArray();
        } else {
            $cart = session()->get('cart', []);
        }

        // Total COM IVA (já está incluso nos preços)
        $total_com_iva = 0;
        foreach ($cart as $item) {
            $total_com_iva += $item['book']->price * $item['quantity'];
        }

        // Cálculo do valor SEM IVA (6%)
        $total_sem_iva = $total_com_iva / 1.06;
        $iva = $total_com_iva - $total_sem_iva;
        if ($total_com_iva == 0 || $total_com_iva > 45.00) {
            $shipping = 0.00;
        }
        else {
            $shipping = 2.00;
        }


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
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())
                ->where('book_id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function updateQuantity(Request $request)
    {
        $bookId = $request->input('book_id');
        $newQuantity = max(1, min($request->input('quantity'), 50));

        if (auth()->check()) {

            Cart::updateOrCreate(
                ['user_id' => auth()->id(), 'book_id' => $bookId],
                ['quantity' => $newQuantity]
            );

            $cartItems = Cart::with('book')->where('user_id', auth()->id())->get();
            $cart = [];
            foreach ($cartItems as $item) {
                $cart[$item->book_id] = [
                    'quantity' => $item->quantity,
                    'book' => $item->book
                ];
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$bookId])) {
                $cart[$bookId]['quantity'] = $newQuantity;
                session()->put('cart', $cart);
            }
        }

        session()->put('cart', $cart);

        $total_com_iva = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['book']->price * $item['quantity']);
        }, 0);

        $total_sem_iva = $total_com_iva / 1.06;
        $iva = $total_com_iva - $total_sem_iva;
        if ($total_com_iva == 0 || $total_com_iva > 45.00) {
            $shipping = 0.00;
        }
        else {
            $shipping = 2.00;
        }
        $total_pagar = $total_com_iva + $shipping;

        return response()->json([
            'success' => true,
            'quantity' => $cart[$bookId]['quantity'],
            'lineTotal' => number_format($cart[$bookId]['quantity'] * $cart[$bookId]['book']->price, 2),
            'total_sem_iva' => number_format($total_sem_iva, 2),
            'iva' => number_format($iva, 2),
            'shipping' => number_format($shipping, 2),
            'total_pagar' => number_format($total_pagar, 2)
        ]);
    }


    public function mergeCart()
    {
        if (auth()->check()) {
            $sessionCart = session()->get('cart', []);

            foreach ($sessionCart as $bookId => $item) {
                Cart::updateOrCreate(
                    ['user_id' => auth()->id(), 'book_id' => $bookId],
                    ['quantity' => \DB::raw("quantity + {$item['quantity']}")]
                );
            }

            session()->forget('cart');
        }
    }

    private function handleResponse()
    {
        // Atualizar contagem corretamente
        $count = auth()->check()
            ? auth()->user()->carts()->count()
            : count(session()->get('cart', []));

        return response()->json([
            'success' => true,
            'cartCount' => $count,
            'message' => 'Livro adicionado com sucesso!'
        ]);
    }

    public function orderConfirmation()
    {
        if (auth()->check()) {
            $cartItems = Cart::with('book')->where('user_id', auth()->id())->get();
            $cart = $cartItems->mapWithKeys(function ($item) {
                return [
                    $item->book_id => [
                        'quantity' => $item->quantity,
                        'book' => $item->book
                    ]
                ];
            })->toArray();
        } else {
            $cart = session()->get('cart', []);
        }

        // Cálculo dos totais
        $total_com_iva = 0;
        foreach ($cart as $item) {
            $total_com_iva += $item['book']->price * $item['quantity'];
        }
        $total_sem_iva = $total_com_iva / 1.06;
        $iva = $total_com_iva - $total_sem_iva;
        $shipping = ($total_com_iva == 0 || $total_com_iva > 45.00) ? 0.00 : 2.00;
        $total_pagar = $total_com_iva + $shipping;

        //dados do user autenticado
        $user = auth()->user();

        return view('cart.order', compact(
            'cart',
            'total_sem_iva',
            'iva',
            'shipping',
            'total_pagar',
            'user'
        ));
    }




}
