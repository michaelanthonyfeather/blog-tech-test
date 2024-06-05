<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //if no users exist, create a user
        if (User::count() === 0) {
            $user = User::factory()->create();
        }

        Post::factory()
            ->count(10)
            ->for($user ?? User::first())
            ->create();
    }
}
