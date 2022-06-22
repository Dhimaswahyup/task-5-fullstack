<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Categories;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Repositories\categories\CategoriesRepository;

class CategoriesController extends Controller
{
    protected $repository;

    public function __construct(CategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return CategoriesResource::collection(
            $this->repository->all()
        );
    }


    public function store(StoreCategoriesRequest $request)
    {
        $categories = $this->repository
                        ->storecategories(
                            auth()->user(),
                            $request->validated()
                        );

        return new CategoriesResource($categories);
    }
    public function show(Categories $categories)
    {
        return new CategoriesResource($categories);
    }

    public function update(UpdateCategoriesRequest $request, Categories $categories)
    {
        $categories = $this->repository->updatecategories($categories, $request->validated());
        return new CategoriesResource($categories);
    }

    public function destroy(Categories $categories)
    {
        $this->authorize('delete', $categories);

        $this->repository->deletecategories($categories);
        return response()->json('OK');
    }
}
