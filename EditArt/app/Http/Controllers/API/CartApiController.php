<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceExtended;
use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CartApiController extends BaseController
{
    public function getCart($user_id)
    {
        if (!User::where('id', $user_id)->exists()) {
            return $this->sendError("User doesn't exist.", null, 400);
        }

        // Get cart items with book details
        $cartItems = Cart::where('user_id', $user_id)
            ->with('book') // Eager load the book relationship
            ->get();

        // Format response with book details and quantity
        $cartData = $cartItems->map(function ($cartItem) {
            return [
                'book' => new BookResource($cartItem->book),
                'quantity' => $cartItem->quantity,
            ];
        });

        return $this->sendResponse($cartData, 'Books from cart retrieved successfully.');
    }
    public function addToCart(Request $request, $user_id)
    {
        // Validate the incoming request
        $request->validate([
            'book_id' => 'required|exists:books,id', // Ensure the book exists
            'quantity' => 'required|integer|min:1', // Quantity must be at least 1
        ]);

        // Check if the user exists
        if (!User::where('id', $user_id)->exists()) {
            return $this->sendError("User doesn't exist.", null, 400);
        }

        // Check if the book is already in the cart
        $cartItem = Cart::where('user_id', $user_id)->where('book_id', $request->book_id)->first();

        if ($cartItem) {
            // If the book is in the cart, increase the quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();

            return $this->sendResponse(null, 'Book quantity updated in cart.');
        }

        // Add the book to the cart if not already present
        Cart::create([
            'user_id' => $user_id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity
        ]);

        return $this->sendResponse(null, 'Book added to cart successfully.');
    }
    public function removeFromCart(Request $request, $user_id)
    {
        // Validate the incoming request
        $request->validate([
            'book_id' => 'required|exists:books,id', // Ensure the book exists
        ]);

        // Check if the user exists
        if (!User::where('id', $user_id)->exists()) {
            return $this->sendError("User doesn't exist.", null, 400);
        }

        // Check if the book is in the cart
        $cartItem = Cart::where('user_id', $user_id)->where('book_id', $request->book_id)->first();

        if (!$cartItem) {
            return $this->sendError("This book is not in your cart.", null, 400);
        }

        // If quantity is more than 1, reduce the quantity
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            return $this->sendResponse(null, 'Book quantity decreased in cart.');
        }

        // If quantity is 1, remove the book from the cart
        $cartItem->delete();

        return $this->sendResponse(null, 'Book removed from cart successfully.');
    }
}

