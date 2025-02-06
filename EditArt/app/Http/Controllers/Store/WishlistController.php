<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Exibe a wishlist do cliente.
     */
    public function index()
    {
        $user = Auth::user();
        $wishlists = Wishlist::with('book')->where('user_id', $user->id)->get();
        return view('wishlist.wishlist', compact('wishlists'));
    }

    /**
     * Adiciona um livro à wishlist.
     */
    public function add($bookId)
    {
        $user = Auth::user();

        // Verifica se o livro já está na wishlist do cliente.
        $exists = Wishlist::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => $user->id,
                'book_id' => $bookId,
            ]);
            return redirect()->back()->with('success', 'Livro adicionado à wishlist!');
        }

        return redirect()->back()->with('info', 'Este livro já está na sua wishlist.');
    }

    /**
     * Remove um livro da wishlist.
     */
    public function remove($bookId)
    {
        $user = Auth::user();
        Wishlist::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->delete();
        return redirect()->back()->with('success', 'Livro removido da wishlist!');
    }
}
