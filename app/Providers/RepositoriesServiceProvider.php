<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Articles\ArticlesRepository;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Articles\EloquentArticlesRepository;
use App\Repositories\Categories\EloquentCategoriesRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CategoriesRepository::class,
            EloquentCategoriesRepository::class
        );

        $this->app->bind(
            ArticlesRepository::class,
            EloquentArticlesRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
