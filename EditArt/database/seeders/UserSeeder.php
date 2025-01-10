<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'edit.art.buisness@gmail.com',
            'email_verified_at' => now(),
            'password' => hash::make('password'),
            'remember_token' => \Str::random(10),
            'address' => fake()->address(),
            'nif' => fake()->randomNumber(9),
            'phone_number' => fake()->randomNumber(9),
            'created_at' => now(),
            'updated_at' => now(),


            'birthdate' => fake()->dateTimeBetween('-30 year', '-10 year'),
            'role' => fake()->numberBetween(1, 5),
        ]);
        \DB::table('users')->insert([
            'name' => 'cliente',
            'email' => 'cliente@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
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

        foreach(User::all() as $user){
            if($user->id == 1)
                $user->assignRole('admin');
            else
                $user->assignRole('cliente');
        }

    }
}
