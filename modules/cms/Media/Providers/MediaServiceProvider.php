<?php
namespace CMS\Media\Providers;

use CMS\Course\Database\Seeds\RolePermissionTableSeeder;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {
       $this->mergeConfigFrom(__DIR__ . "/../Config/mediaFile.php", 'mediaFile');
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
       $this->loadRoutesFrom(__DIR__."/../routes/media_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Media");
    }

    public function boot()
    {
        /*$this->app->booted(function (){
            config()->set("AdminSidebar.media",[
                "name" => "رسانه ها",
                "link" => route("admin_list_media"),
                "icon" => "fa-camera",
                "children"=>[
                    ["name"=>"لیست رسانه ها","link"=>route("admin_list_media")],
                    ["name"=>"افزودن رسانه","link"=>route("admin_add_media")],
                ]
            ]);
        });*/
    }
}
