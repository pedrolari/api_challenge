<?php

namespace App\Providers;


use App\Repositories\FeatureRepository;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Services\FeatureService;
use App\Services\Interfaces\FeatureServiceInterface;
use Illuminate\Support\ServiceProvider;

class FeatureProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(FeatureServiceInterface::class, FeatureService::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
    }
}
