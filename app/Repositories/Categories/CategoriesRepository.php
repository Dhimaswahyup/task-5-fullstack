<?php

namespace App\Repositories\Categories;

use App\Models\User;
use App\Models\Categories;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoriesRepository
{
    public function all(): LengthAwarePaginator;
    public function storeCategory(User $user, $array): Categories;
    public function updateCategory(Categories $category, $array): Categories;
    public function deleteCategory(Categories $category): bool;
}
