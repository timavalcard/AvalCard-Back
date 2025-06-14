<?php

namespace CMS\User\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use CMS\User\Models\User;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","User");
        $this->loadRoutesFrom(__DIR__."/../routes/user_route.php");

        $this->loadFactoriesFrom(__DIR__."/../Database/factories");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        $this->loadJsonTranslationsFrom(__DIR__."/../Resources/Lang");
        config()->set("auth.providers.users.model",User::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->booted(function (){
            config()->set("AdminSidebar.authorize",[
                "name" => "درخواست احراز هویت",
                "link" => route("admin_list_authorize"),
                "icon" => "fa-user-circle",
                "children" => [
                    ["name"=>"لیست درخواست ها","link"=>route("admin_list_authorize")],
                    ["name"=>"لیست کاربر های احراز شده","link"=>route("admin_list_authorized")],
                    ["name"=>"لیست کاربر های رد شده","link"=>route("admin_list_not_authorized")],
                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS
            ]);



            config()->set("AdminSidebar.user",[
                "name" => "کاربران",
                "link" => route("admin_list_user"),
                "icon" => "fa-user-circle",
                "children" => [
                    ["name"=>"لیست کاربران","link"=>route("admin_list_user")],
                    ["name"=>"اضافه کردن کاربر","link"=>route("admin_add_user")],
                 //   ["name"=>"نقش های کاربری","link"=>route("role-permissions.index")],
                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS
            ]);
            if (Auth::check()) {
                config()->set("AdminSidebar.profile", [
                    "name" => "ویرایش پروفایل",
                    "link" => route("admin_edit_user", ["id" => Auth::user()->id]),
                    "icon" => "fa-profile",

                ]);
            }
        });

    }
}
