<?php

namespace CMS\Cart\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Category\Models\Category;
use CMS\Product\Models\Product;
use CMS\Product\policies\ProductPolicy;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views/","Cart");
        $this->loadRoutesFrom(__DIR__ . "/../routes/cart_route.php");
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
