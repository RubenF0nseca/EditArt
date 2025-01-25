<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Book;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->input('title');
        $genreId = $request->query('genre');

        $genres = Genre::all();

        $books = Book::when($title, fn($query) => $query->title($title))
            ->byGenre($genreId)
            ->paginate(12);

        return view('guest.books', ['books' => $books, 'genres' => $genres]);
    }

    public function showBook(Book $book)
    {
        return view('client.book', compact('book'));
    }
}
