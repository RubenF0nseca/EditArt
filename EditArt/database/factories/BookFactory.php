<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'type' => fake()->randomElement(['book', 'ebook']),
            'publicationDate' => fake()->dateTimeBetween('-2 years'),
            'editionNumber' => fake()->randomNumber('1'),
            'isbn' => fake()->unique()->isbn13(),
            'numberOfPages' => fake()->randomNumber(2),
            'stock' => fake()->randomNumber(2),
            'language' => fake()->languageCode(),
            'price' => fake()->randomFloat(2, 10, 50),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at']);
            }
        ];
    }
}
