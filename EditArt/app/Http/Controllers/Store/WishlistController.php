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

    public function add($bookId)
    {
        $user = auth()->user();
        $exists = $user->wishlists()->where('book_id', $bookId)->exists();

        if (!$exists) {
            $user->wishlists()->create([
                'book_id' => $bookId,
            ]);
            return response()->json(['success' => true, 'message' => 'Livro adicionado à wishlist!']);
        }

        return response()->json(['success' => false, 'message' => 'Este livro já está na sua wishlist.']);
    }

// remover da wishlist
    public function remove(Request $request, $bookId)
    {
        $user = auth()->user();
        $deleted = $user->wishlists()->where('book_id', $bookId)->delete();

        if ($request->ajax()) { // Requisições AJAX
            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Livro removido da wishlist!']);
            }
            return response()->json(['success' => false, 'message' => 'Erro ao remover o livro da wishlist.']);
        } else { // Requisições normais (não-AJAX)
            if ($deleted) {
                return redirect()->back()->with('success', 'Livro removido da wishlist!');
            }
            return redirect()->back()->with('error', 'Erro ao remover o livro da wishlist.');
        }
    }
}
