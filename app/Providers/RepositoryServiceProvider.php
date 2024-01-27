<?php

namespace App\Providers;

use App\Http\Interfaces\Api\CategoryInterface;
use App\Http\Interfaces\Api\ProductInterface;
use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\CartInterface;
use App\Http\Interfaces\HomeInterface;
use App\Http\Interfaces\OrderInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\HomeRepository;
use App\Http\Interfaces\RegisterInterface;
use App\Http\Repositories\Api\CategoryRepository;
use App\Http\Repositories\Api\ProductRepository;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\CartRepository;
use App\Http\Repositories\OrderRepository;
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
        $this->app->bind(AuthInterface::class ,AuthRepository::class);
        $this->app->bind(CartInterface::class ,CartRepository::class);
        $this->app->bind(OrderInterface::class ,OrderRepository::class);

        //Api
        $this->app->bind(ProductInterface::class ,ProductRepository::class);
        $this->app->bind(CategoryInterface::class ,CategoryRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
