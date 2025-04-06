<?php

namespace CMS\Setting\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Category\Models\Category;
use CMS\Product\Models\Product;
use CMS\Product\policies\ProductPolicy;
use CMS\RolePermissions\Models\Permission;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Setting");
        $this->loadRoutesFrom(__DIR__."/../routes/setting_route.php");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function (){
            config()->set("AdminSidebar.setting",[
                "name" => "تنظیمات",
                "link" => "#",
                "icon" => "fa-cog",
                "children"=>[
                    ["name"=>"تنظیمات ارسال ایمیل","link"=>route("admin_email")],
                    ["name"=>"تنظیمات ربات تلگرامی ","link"=>route("admin_tel_bot")],
                ],
                "permission"=>Permission::PERMISSION_SUPER_ADMIN

            ]);

        });
    }
}
