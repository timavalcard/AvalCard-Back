<?php



namespace CMS\Tools\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class ToolsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/tools_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Tools");
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
            config()->set("AdminSidebar.tools",[
                "name" => "ابزارها",
                "link" => route("admin_tools"),
                "icon" => "fa-wrench",
                "children"=>[
                    ["name"=>"درون ریزی","link"=>"#"],
                    ["name"=>"بکاپ گیری","link"=>"#"],
                ]

            ]);
        });
    }
}
