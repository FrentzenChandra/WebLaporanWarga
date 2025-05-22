<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\ResidentRepositoryInterface;
use App\Repositories\ResidentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(ResidentRepositoryInterface::class,ResidentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
