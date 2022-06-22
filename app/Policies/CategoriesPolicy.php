<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Categories $categories)
    {
        return true;
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, Categories $categories)
    {
        return $categories->user_id === $user->id;
    }
    public function delete(User $user, Categories $categories)
    {
        return $categories->user_id === $user->id;
    }
    public function restore(User $user, Categories $categories)
    {
        return $categories->user_id === $user->id;
    }
    public function forceDelete(User $user, Categories $categories)
    {
        return $categories->user_id === $user->id;
    }
}
