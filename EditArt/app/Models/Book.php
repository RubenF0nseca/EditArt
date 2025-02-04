<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

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

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
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

    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ]);
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ], 'rating');
    }

    // os mais populares neste caso sao os que recebem mais reviews
    public function scopePopular(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withReviewsCount()
            ->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query): Builder|QueryBuilder
    {
        return $query->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews(Builder $query, int $minReviews): Builder|QueryBuilder
    {
        return $query->where('reviews_count', '>=', $minReviews);
    }

    private function dateRangeFilter(Builder $query, $from = null, $to = null)
    {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    // Scope para filtrar por género
    public function scopeByGenre($query, $genreId)
    {
        if ($genreId) {
            $query->whereHas('genres', function ($query) use ($genreId) {
                $query->where('genres.id', $genreId);
            });
        }

        return $query;
    }

    // Classificar os livros em stock por ordem crescente no dashboard
    public function scopeStock($query)
    {
        return $query->orderBy('stock','asc');
    }
}
