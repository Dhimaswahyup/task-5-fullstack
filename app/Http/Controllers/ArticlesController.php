<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Http\Requests\StoreArticlesRequest;
use App\Http\Requests\UpdateArticlesRequest;
use App\Repositories\Articles\ArticlesRepository;

class ArticlesController extends Controller
{
    protected $repository;

    public function __construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('post.index', [
            'posts' => $this->repository->all()
        ]);
    }

    public function create()
    {
        return view('post.create', [
            'categories' => Categories::orderBy('name', "ASC")->get()
        ]);
    }


    public function store(StoreArticlesRequest $request)
    {
        $post = $this->repository
                    ->storePost(
                        auth()->user(),
                        $request
                    );

        return redirect()->route('posts.show', ['post' => $post]);
    }


    public function show(Articles $post)
    {
        return view('post.show', ['post' => $post]);
    }

    public function edit(Articles $post)
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => Categories::orderBy('name', "ASC")->get()
        ]);
    }


    public function update(UpdateArticlesRequest $request, Articles $post)
    {
        $post = $this->repository->updatePost($post, $request);
        return redirect()->route('posts.show', ['post' => $post]);
    }


    public function destroy(Articles $post)
    {
        $this->authorize('delete', $post);
        $this->repository->deletePost($post);
        return redirect()->route('posts.index');
    }
}
