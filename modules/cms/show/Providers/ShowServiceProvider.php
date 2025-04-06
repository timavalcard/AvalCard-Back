<?php



namespace CMS\Show\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;
use CMS\RolePermissions\Models\Permission;

class ShowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->loadRoutesFrom(__DIR__ . "/../routes/show_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Show");
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
            config()->set("AdminSidebar.show",[
                "name" => 'نمایش',
                "link" => '#',
                "icon" => "fa-paint-brush",
                "children"=>[
                    ["name"=>'منو',"link"=>route("admin_add_menu")],
                    ["name"=>'تنظیمات قالب',"link"=>route("admin_theme_setting_list")],
                ],
                "permission"=>Permission::PERMISSION_SHOW_MANAGER

            ]);
        });
    }
}
