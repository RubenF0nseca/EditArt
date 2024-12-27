<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'publicationDate',
        'editionNumber',
        'isbn',
        'numberOfPages',
        'stock',
        'language',
        'price',
        'CoverPicture',
    ];

    /**
     * Relacionamento 1:N para transações como cliente.
     */
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'user_id', 'id');
    }

    /**
     * Relacionamento 1:N para reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id', 'id');
    }

    /**
     * Relação muitos-para-muitos com o modelo Author.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_books', 'book_id', 'author_id');
    }

    /**
     * Relação muitos-para-muitos com o modelo Genre.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'books_genres', 'book_id', 'genre_id');
    }
}
