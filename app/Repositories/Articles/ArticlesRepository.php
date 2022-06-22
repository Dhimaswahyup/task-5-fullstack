<?php

namespace App\Repositories\Articles;

use App\Models\Articles;
use App\Models\User;
use App\Http\Requests\StoreArticlesRequest;
use App\Http\Requests\UpdateArticlesRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ArticlesRepository
{
    public function all(): LengthAwarePaginator;
    public function storePost(User $user, StoreArticlesRequest $request): Articles;
    public function updatePost(Articles $post, UpdateArticlesRequest $request): Articles;
    public function deletePost(Articles $post): bool;
}
