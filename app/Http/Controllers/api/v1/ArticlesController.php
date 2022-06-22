<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Articles;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticlesResource;
use App\Http\Resources\ArticlesCollection;
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
        return new ArticlesCollection($this->repository->all());
    }

    public function store(StoreArticlesRequest $request)
    {
        $articles = $this->repository
                    ->storearticles(
                        auth()->user(),
                        $request
                    );

        return new ArticlesResource($articles);
    }


    public function show(Articles $articles)
    {
        return new ArticlesResource($articles);
    }


    public function update(UpdateArticlesRequest $request, Articles $articles)
    {
        $articles = $this->repository->updatearticles($articles, $request);
        return new ArticlesResource($articles);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $articles)
    {
        $this->authorize('delete', $articles);

        $this->repository->deletearticles($articles);
        return response()->json('OK');
    }
}
