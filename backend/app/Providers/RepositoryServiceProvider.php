<?php

namespace App\Providers;

use App\Repositories\Interfaces\IProductImageRepository;
use App\Repositories\Interfaces\IProductRepository;
use App\Repositories\Interfaces\IProductReviewRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductReviewRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->bind(
            IProductRepository::class,
            ProductRepository::class
        );*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
