<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $genres  = Genre::all();

        Book::factory(34)->create()->each(function ($book) use ($authors, $genres) {
            if ($authors->count()) {
                $book->authors()->attach(
                    $authors->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
            if ($genres->count()) {
                $book->genres()->attach(
                    $genres->random(rand(1, 2))->pluck('id')->toArray()
                );
            }
            // Cria um número aleatório de reviews do tipo "bad" para o livro
            $numReviews = random_int(5, 15);
            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) use ($authors, $genres) {
            if ($authors->count()) {
                $book->authors()->attach(
                    $authors->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
            if ($genres->count()) {
                $book->genres()->attach(
                    $genres->random(rand(1, 2))->pluck('id')->toArray()
                );
            }
            $numReviews = random_int(5, 15);
            Review::factory()->count($numReviews)
                ->good()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) use ($authors, $genres) {
            if ($authors->count()) {
                $book->authors()->attach(
                    $authors->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
            if ($genres->count()) {
                $book->genres()->attach(
                    $genres->random(rand(1, 2))->pluck('id')->toArray()
                );
            }
            $numReviews = random_int(5, 15);
            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });
    }
}
