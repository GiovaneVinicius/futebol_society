<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PlayerRepository;
use App\Repositories\PlayerRepositoryInterface;
use App\Repositories\FootballMatchRepository;
use App\Repositories\FootballMatchRepositoryInterface;
use App\Repositories\MatchPlayerRepository;
use App\Repositories\MatchPlayerRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(FootballMatchRepositoryInterface::class, FootballMatchRepository::class);
        $this->app->bind(MatchPlayerRepositoryInterface::class, MatchPlayerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
