<?php

namespace App\Repositories\Categories;

use App\Models\User;
use App\Models\Categories;
use App\Repositories\Categories\CategoriesRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCategoriesRepository implements CategoriesRepository
{
    public function all(): LengthAwarePaginator
    {
        return Categories::latest('updated_at')->paginate(5);
    }

    public function storeCategory(User $user, $array): Categories
    {
        return $user->categories()->create($array);
    }

    public function updateCategory(Categories $Categories, $array): Categories
    {
        $Categories->update($array);
        return $Categories;
    }

    public function deleteCategory(Categories $Categories): bool
    {
        return $Categories->delete();
    }
}
