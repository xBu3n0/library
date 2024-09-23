<?php

namespace App\Providers;

use App\Interactors\CartInteractor;
use App\Interactors\CartInteractorI;
use App\Models\User;
use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryI;
use App\Services\ResponseService;
use App\Services\ResponseServiceI;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ResponseServiceI::class, ResponseService::class);
        $this->app->bind(CartInteractorI::class, CartInteractor::class);
        $this->app->bind(CartRepositoryI::class, CartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(User::class);
    }
}
