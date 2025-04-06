<?php



namespace CMS\Portfolio\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class PortfolioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/portfolio_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Portfolio");
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
            config()->set("AdminSidebar.portfolio",[
                "name" => "نمونه کارها",
                "link" => route("admin_list_portfolio"),
                "icon" => "fa-briefcase ",

            ]);
        });
    }
}
