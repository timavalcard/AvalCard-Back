<?php



namespace CMS\Seo\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;
use CMS\RolePermissions\Models\Permission;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/seo_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Seo");
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
            config()->set("AdminSidebar.seo",[
                "name" => "مدیریت سئو",
                "link" => route("admin_seo"),
                "icon" => "fa-search",
                "children"=>[
                    [ "name"=>"خانه","link"=>route("admin_seo")],
                    [ "name"=>"تغییر مسیر ها (redirects)","link"=>route("admin_seo_redirect")],
                    [ "name"=>"نمایه سازی فوری گوگل","link"=>route("admin_seo_google")],
                    [ "name"=>"نمایه سازی فوری bing","link"=>route("admin_seo_bing")],
                  ],
                "permission"=>Permission::PERMISSION_SEO_MANAGER
            ]);
        });
    }
}
