<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(){
        $users_count=User::all()->count();
        $products_count=Book::all()->count();
        $authors_count=Author::all()->count();
        $reviews_count=Review::all()->count();

        return view('admin.dashboard', compact('users_count', 'products_count', 'authors_count', 'reviews_count'));
    }
}
