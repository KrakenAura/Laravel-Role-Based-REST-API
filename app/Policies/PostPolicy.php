<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Post $post): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'editor') {
            return $post->user_id === $user->id;
        }

        return false;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }
}
