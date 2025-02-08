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
            'description' => $this->description,
            'type' => $this->type,
            'publicationDate' => $this->publicationDate,
            'editionNumber' => $this->editionNumber,
            'isbn' => $this->isbn,
            'numberOfPages' => $this->numberOfPages,
            'stock' => $this->stock,
            'language' => $this->language,
            'price' => $this->price,
            'CoverPicture' => $this->CoverPicture,
            'authors' => $this->authors->pluck('name')->implode(', '),
            'genres' => $this->genres->pluck('name')->implode(', '),
            'reviews_count' => $this->reviews()->count(),
            'rating' => round($this->reviews()->avg('rating'), 1),
        ];
    }
}

