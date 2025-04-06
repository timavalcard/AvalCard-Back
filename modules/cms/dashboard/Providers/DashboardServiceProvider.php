<?php

namespace CMS\Dashboard\Providers;


use Illuminate\Support\ServiceProvider;
use CMS\Dashboard\Http\Middleware\DashboardAdminMiddleware;

class DashboardServiceProvider extends ServiceProvider
{
    public function boot(){
         $this->loadRoutesFrom(__DIR__."/../routes/dashboard_routes.php");
         $this->loadMigrationsFrom(__DIR__."/../Database/Migrations/");
         $this->loadViewsFrom(__DIR__.'/../Resources/Views/','Dashboard');
//         $this->loadViewComponentsAs('App\View\Components',['appAdmin']);
        $this->app['router']->aliasMiddleware('DashboardAdminMiddleware',DashboardAdminMiddleware::class);

    }
}
