<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceExtended;
use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends BaseController
{
    public function getBooks(Request $request)
    {
        $books = Book::all();

        $booksArray = [];

        foreach ($books as $book) {
            $booksArray[] = new BookResource($book);
        }

        return $this->sendResponse($booksArray, 'Books retrieved successfully.');
    }

    public function getBook($id)
    {
        $book = Book::with(['authors', 'genres', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->find($id);

        if (!$book) {
            return $this->sendError('Book not found.');
        }

        return $this->sendResponse(new BookResourceExtended($book), 'Book retrieved successfully.');
    }
}

