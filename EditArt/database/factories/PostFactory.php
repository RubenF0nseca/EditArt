<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => substr(fake()->unique()->sentence(2), 0, 25),
            'content' => fake()->paragraphs(1, true),
            'user_id' =>fake()->numberBetween(1, User::count()),

        ];
    }
}
