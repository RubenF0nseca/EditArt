<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceExtended;
use App\Models\Book;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistApiController extends BaseController
{
    public function getWishlist($user_id)
    {
        if (!User::where('id', $user_id)->exists()) {
            return $this->sendError("User doesn't exist.", null, 400);
        }

        // Obtém os IDs dos livros da wishlist do usuário
        $bookIds = Wishlist::where('user_id', $user_id)->pluck('book_id');

        // Busca os livros correspondentes na tabela 'books'
        $books = Book::whereIn('id', $bookIds)->get();

        return $this->sendResponse(BookResource::collection($books), 'Books from wishlist retrieved successfully.');
    }

    public function addToWishlist(Request $request, $user_id)
    {
        // Validate the incoming request
        $request->validate([
            'book_id' => 'required|exists:books,id', // Ensure the book exists
        ]);

        // Check if the user exists
        if (!User::where('id', $user_id)->exists()) {
            return $this->sendError("User doesn't exist.", null, 400);
        }

        // Check if the book is already in the wishlist
        $wishlistItem = Wishlist::where('user_id', $user_id)->where('book_id', $request->book_id)->first();

        if ($wishlistItem) {
            return $this->sendError("This book is already in your wishlist.", null, 400);
        }

        // Add the book to the wishlist
        Wishlist::create([
            'user_id' => $user_id,
            'book_id' => $request->book_id
        ]);

        return $this->sendResponse(null, 'Book added to wishlist successfully.');
    }
    public function removeFromWishlist(Request $request, $user_id)
    {
        // Validate the incoming request
        $request->validate([
            'book_id' => 'required|exists:books,id', // Ensure the book exists
        ]);

        // Check if the user exists
        if (!User::where('id', $user_id)->exists()) {
            return $this->sendError("User doesn't exist.", null, 400);
        }

        // Check if the book is in the wishlist
        $wishlistItem = Wishlist::where('user_id', $user_id)->where('book_id', $request->book_id)->first();

        if (!$wishlistItem) {
            return $this->sendError("This book is not in your wishlist.", null, 400);
        }

        // Remove the book from the wishlist
        $wishlistItem->delete();

        return $this->sendResponse(null, 'Book removed from wishlist successfully.');
    }

}

