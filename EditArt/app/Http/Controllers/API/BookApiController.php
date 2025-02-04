<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends BaseController
{
    public function getBooks(Request $request)
    {
        $books = Book::all();

        if ($request->has('title')) {
            $query->title($request->title);
        }
        if ($request->has('popular')) {
            $query->popular();
        }
        if ($request->has('highest_rated')) {
            $query->highestRated();
        }
        if ($request->has('min_reviews')) {
            $query->minReviews($request->min_reviews);
        }
        if ($request->has('genre')) {
            $query->byGenre($request->genre);
        }

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

        return $this->sendResponse(new BookResource($book), 'Book retrieved successfully.');
    }
}

