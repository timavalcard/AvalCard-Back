<?php



namespace CMS\Club\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;
use CMS\RolePermissions\Models\Permission;

class ClubServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/club_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Club");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*$this->app->booted(function (){
        config()->set("AdminSidebar.club",[
            "name" => "باشگاه مشتریان",
            "link" => route("admin_club_index"),
            "icon" => "fa-users",
            "children"=>[
                ["name"=>"امتیازات کاربران","link"=>route("admin_club_index")],
                ["name"=>"تنظیمات","link"=>route("admin_club_settings")],
            ],
            "permission"=>Permission::PERMISSION_SUPER_ADMIN
        ]);
    });*/
    }


}
