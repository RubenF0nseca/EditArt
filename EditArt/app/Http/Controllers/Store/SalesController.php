<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->input('title');

        $books = Book::when(
            $title,
            fn($query, $title) => $query->title($title)
        )
            ->paginate(12);

        return view('guest.books' , ['books' => $books]);
    }
}
