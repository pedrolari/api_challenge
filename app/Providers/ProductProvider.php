<?php

namespace App\Providers;


use App\Repositories\Interfaces\ProductFeatureRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductFeatureRepository;
use App\Repositories\ProductRepository;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductFeatureRepositoryInterface::class, ProductFeatureRepository::class);
    }
}
