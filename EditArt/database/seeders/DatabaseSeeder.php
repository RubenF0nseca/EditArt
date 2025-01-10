<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'edit.art.buisness@gmail.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => \Str::random(10),
            'address' => fake()->address(),
            'nif' => fake()->randomNumber(9),
            'phone_number' => fake()->randomNumber(9),
            'created_at' => now(),
            'updated_at' => now(),


            'birthdate' => fake()->dateTimeBetween('-30 year', '-10 year'),
            'role' => fake()->numberBetween(1, 5),
        ]);
        User::factory(10)->create();

        $this->call([
            BookSeeder::class,
            AuthorSeeder::class,
            ReviewSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            GenreSeeder::class,
        ]);

    }
}
