<?php

namespace App\Policies;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Articles $post)
    {
        return true;
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, Articles $post)
    {
        return $user->id === $post->user_id;
    }
    public function delete(User $user, Articles $post)
    {
        return $user->id === $post->user_id;
    }

    public function restore(User $user, Articles $post)
    {
        return $user->id === $post->user_id;
    }
    public function forceDelete(User $user, Articles $post)
    {
        return $user->id === $post->user_id;
    }
}
