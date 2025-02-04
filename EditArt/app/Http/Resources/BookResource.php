<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'publicationDate' => $this->publicationDate,
            'editionNumber' => $this->editionNumber,
            'isbn' => $this->isbn,
            'numberOfPages' => $this->numberOfPages,
            'stock' => $this->stock,
            'language' => $this->language,
            'price' => $this->price,
            'CoverPicture' => $this->CoverPicture,
            'authors' => $this->authors->pluck('name'),
            'genres' => $this->genres->pluck('name'),
            'reviews' => $this->reviews->map(fn($review) => [
                'id' => $review->id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'created_at' => $review->created_at->toDateTimeString(),
                'user' => $review->user->name ?? null
            ]),
            'reviews_count' => $this->reviews()->count(),
            'rating' => $this->reviews()->avg('rating'),
        ];
    }
}

