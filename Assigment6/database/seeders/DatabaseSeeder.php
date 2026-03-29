<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $author = User::factory()->create([
            'name' => 'Article Author',
            'email' => 'author@example.com',
        ]);

        Article::create([
            'user_id' => $author->id,
            'title' => 'Welcome to the article system',
            'content' => "This article belongs to the author user.\n\nModerators can read and edit it but cannot create new articles.",
        ]);

        User::factory()->create([
            'name' => 'Site Moderator',
            'email' => 'moderator@example.com',
            'role' => 'moderator',
        ]);
    }
}
