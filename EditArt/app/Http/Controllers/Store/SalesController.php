<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Review;
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
        $book->load('reviews.user');

        $reviewsCount = $book->reviews()->count();
        $averageRating = $book->reviews()->avg('rating');

        $wholeStars = floor($averageRating);
        $hasHalfStar = ($averageRating - $wholeStars) >= 0.5;

        return view('client.book', compact('book', 'reviewsCount', 'averageRating', 'wholeStars', 'hasHalfStar'));
    }

    public function createBookReview(Request $request, Book $book)
    {
        //dd($request->all());
        // Validação dos dados
        $request->validate([
            'topic' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($book->reviews()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'Já fizeste uma avaliação para este livro.');
        }

        Review::create([
            'book_id' => $book->id,
            'user_id' => auth()->id(),
            'comment' => $request->input('content'),
            'topic' => $request->input('topic'),
            'rating' => $request->input('rating'),
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Avaliação enviada com sucesso!');
    }
}
