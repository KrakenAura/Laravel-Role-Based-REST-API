<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $editor = User::where('role', 'editor')->first();

        Post::create([
            'user_id' => $admin->id,
            'title' => 'Admin Post',
            'content' => 'This post was created by admin.',
            'status' => 'published',
        ]);

        Post::create([
            'user_id' => $editor->id,
            'title' => 'Editor Draft',
            'content' => 'This post is still a draft.',
            'status' => 'draft',
        ]);
    }
}
