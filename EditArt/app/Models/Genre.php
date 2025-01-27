<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /** @use HasFactory<\Database\Factories\GenreFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Relação muitos-para-muitos com o modelo Book.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_genres', 'genre_id', 'book_id');
    }

    public function scopeName(Builder $query, string $name): Builder
    {
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }
}
