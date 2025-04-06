<?php
namespace CMS\Menu\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CMS\Menu\Models\Menu;
use CMS\Menu\policies\MenuPolicy;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/menu_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Menu");
       // $this->loadFactoriesFrom(__DIR__."/../Database/factories");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        $this->mergeConfigFrom(__DIR__."/../config/menu_items.php","MenuItem");
        Gate::policy(Menu::class,MenuPolicy::class);
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
