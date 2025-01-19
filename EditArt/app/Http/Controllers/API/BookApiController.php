<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookApiController extends BaseController
{
    /**
     * Display a listing of all books.
     */
    public function getBooks()
    {
        $books = Book::all();
        return $this->sendResponse($books, 'Books retrieved successfully.');
    }

    /**
     * Display the specified book by ID.
     */
    public function getBook($id)
    {
        $book = Book::find($id);

        if (is_null($book)) {
            return $this->sendError('Book not found.');
        }

        $aux1 = $book->authors;
        $aux2 = $book->genres;
        $aux3 = $book->reviews;
        return $this->sendResponse($book, 'Book retrieved successfully.');
    }
}
