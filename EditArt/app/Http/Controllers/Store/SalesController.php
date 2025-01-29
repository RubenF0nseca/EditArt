<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Review;
use HTMLPurifier;
use HTMLPurifier_Config;
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
        $request->validate([
            'topic' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($book->reviews()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'Já fizeste uma avaliação para este livro.');
        }

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $sanitizedContent = $purifier->purify($request->input('comment'));

        Review::create([
            'book_id' => $book->id,
            'user_id' => auth()->id(),
            'comment' => $sanitizedContent,
            'topic' => $request->input('topic'),
            'rating' => $request->input('rating'),
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Avaliação enviada com sucesso!');
    }

    public function updateBookReview(Request $request, Book $book, Review $review)
    {

        $request->validate([
            'topic' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        //TODOmeter 403
        if ($review->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'Não tens permissões para editar esta avaliação.');
        }

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $sanitizedContent = $purifier->purify($request->input('comment'));

        $review->update([
            'comment' => $sanitizedContent,
            'topic' => $request->input('topic'),
            'rating' => $request->input('rating'),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Avaliação atualizada com sucesso!');
    }

    public function deleteBookReview(Book $book, Review $review)
    {
        if ($review->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'Não tens permissões para apagar esta avaliação.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Avaliação apagada com sucesso!');
    }
}
