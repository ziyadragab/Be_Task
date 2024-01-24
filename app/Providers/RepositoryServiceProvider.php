<?php

namespace App\Providers;

use App\Http\Interfaces\HomeInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\HomeRepository;
use App\Http\Interfaces\RegisterInterface;
use App\Http\Repositories\RegisterRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(HomeInterface::class ,HomeRepository::class);
        $this->app->bind(RegisterInterface::class ,RegisterRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
