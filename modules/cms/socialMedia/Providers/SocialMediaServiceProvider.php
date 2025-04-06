<?php



namespace CMS\SocialMedia\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class SocialMediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/socialMedia_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","SocialMedia");
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
            config()->set("AdminSidebar.socialMedia",[
                "name" => "شبکه های اجتماعی",
                "link" => route("admin_socialMedia"),
                "icon" => "fa-thumbs-up",
                "children"=>[
                    ["name"=>"ایسنتاگرام","link"=>route("admin_socialMedia")],
                    ["name"=>"تلگرام","link"=>route("admin_socialMedia")],
                    ["name"=>"تویتر","link"=>route("admin_socialMedia")],
                ],
            ]);
        });
    }
}
