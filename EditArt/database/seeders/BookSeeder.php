<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Os Lusíadas',
                'type' => 'book',
                'publicationDate' => '1572-01-01',
                'editionNumber' => 1,
                'isbn' => '1234567890123',
                'numberOfPages' => 693,
                'stock' => 8,
                'language' => 'Portuguese',
                'CoverPicture' => 'books/blanditiisvelveritatis._1732813299.png',
                'price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Don Quixote',
                'type' => 'book',
                'publicationDate' => '1605-01-01',
                'editionNumber' => 1,
                'isbn' => '9876543210123',
                'numberOfPages' => 863,
                'stock' => 5,
                'language' => 'Spanish',
                'CoverPicture' => 'books/donquixote_1732894554.jpeg',
                'price' => 25.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pride and Prejudice',
                'type' => 'book',
                'publicationDate' => '1813-01-28',
                'editionNumber' => 1,
                'isbn' => '9780141439518',
                'numberOfPages' => 432,
                'stock' => 10,
                'language' => 'English',
                'CoverPicture' => 'books/atqueomnisvel._1732813353.jpg',
                'price' => 15.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Great Gatsby',
                'type' => 'book',
                'publicationDate' => '1925-04-10',
                'editionNumber' => 1,
                'isbn' => '9780743273565',
                'numberOfPages' => 180,
                'stock' => 7,
                'language' => 'English',
                'CoverPicture' => 'books/quoquamaut._1732813361.jpg',
                'price' => 12.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Moby-Dick',
                'type' => 'book',
                'publicationDate' => '1851-11-14',
                'editionNumber' => 1,
                'isbn' => '9781503280786',
                'numberOfPages' => 585,
                'stock' => 4,
                'language' => 'English',
                'CoverPicture' => 'books/moby-dick_1732894542.png',
                'price' => 18.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Book::factory(34)->create()->each(function ($book) {
            $numReviews = random_int(10, 30);

            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();

        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(10, 30);

            Review::factory()->count($numReviews)
                ->good()
                ->for($book)
                ->create();

        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(10, 30);

            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();

        });

    }
}
