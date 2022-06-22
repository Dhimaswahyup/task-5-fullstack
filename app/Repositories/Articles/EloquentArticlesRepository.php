<?php

namespace App\Repositories\Articles;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\StoreArticlesRequest;
use App\Http\Requests\UpdateArticlesRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentArticlesRepository implements ArticlesRepository
{
    public function all(): LengthAwarePaginator
    {
        return Articles::latest('updated_at')->paginate(5);
    }

    public function storePost(User $user, StoreArticlesRequest $request): Articles
    {
        $fileName = $this->saveImage($request);

        return $user->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'image' => $fileName
        ]);
    }

    public function updatePost(Articles $post, UpdateArticlesRequest $request): Articles
    {
        $fileName = $this->saveImage($request) ?? $post->image;

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'image' => $fileName
        ]);

        return $post;
    }

    public function deletePost(Articles $post): bool
    {
        return $post->delete();
    }

    private function saveImage(FormRequest $request): string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $fileName = Str::slug($request->title, '-') . '-' . $file->hashName();

        $file->storeAs('public', $fileName);

        return $fileName;
    }
}
