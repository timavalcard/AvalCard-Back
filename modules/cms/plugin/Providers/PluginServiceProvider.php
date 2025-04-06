<?php



namespace CMS\Plugin\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/plugin_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Plugin");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        //$this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        $this->app->booted(function (){
            config()->set("AdminSidebar.plugin",[
                "name" => "افزونه ها",
                "link" => route("admin_plugin"),
                "icon" => "fa-plug",

            ]);
        });
    }
}
