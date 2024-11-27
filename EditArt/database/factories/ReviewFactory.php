<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_book' => fake()->randomNumber(1),
            'id_user' => fake()->randomNumber(1),
            'comment' => fake()->paragraphs(2, true),
            'rating' => fake()->numberBetween(1, 5),
            'review_date' => now(),
        ];
    }
}
