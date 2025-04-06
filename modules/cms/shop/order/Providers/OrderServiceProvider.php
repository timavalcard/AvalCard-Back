<?php



namespace CMS\Order\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/order_route.php");
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");

        $this->loadViewsFrom(__DIR__ . "/../Resources/Views/","Order");
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
        $this->loadFactoriesFrom(__DIR__ . "/../Database/factories");

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
