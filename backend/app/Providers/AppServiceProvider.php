<?php

namespace App\Providers;

use App\Interactors\BookInteractor;
use App\Interactors\BookInteractorI;
use App\Interactors\CartInteractor;
use App\Interactors\CartInteractorI;
use App\Models\Genre;
use App\Models\User;
use App\Policies\GenrePolicy;
use App\Policies\NotificationPolicy;
use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryI;
use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryI;
use App\Services\ResponseService;
use App\Services\ResponseServiceI;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;
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
        $this->app->bind(BookRepositoryI::class, BookRepository::class);
        $this->app->bind(BookInteractorI::class, BookInteractor::class);

        // Policies
        Gate::policy(DatabaseNotification::class, NotificationPolicy::class);
        Gate::policy(Genre::class, GenrePolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(User::class);
    }
}
