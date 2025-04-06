<?php



namespace CMS\Statistics\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class StatisticsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/statistics_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Statistics");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        $this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        $this->app->booted(function (){
            config()->set("AdminSidebar.statistics",[
                "name" => "آمار",
                "link" => route("admin_statistics"),
                "icon" => "fa-bar-chart",
            ]);
        });
    }
}
