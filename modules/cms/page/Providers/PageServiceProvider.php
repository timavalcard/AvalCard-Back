<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 10:05 PM
 */

namespace CMS\Page\Providers;


use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use CMS\Page\Models\Page;
use CMS\Page\policies\PagePolicy;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/page_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Page");
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

        if(Schema::hasTable('pages')) {
            Gate::policy(Page::class,PagePolicy::class);
            config()->set("MenuItem.items.برگه ها", ["items"=>Page::get(),"type"=>"page"]);
        }

        $this->app->booted(function (){
            config()->set("AdminSidebar.page",[
                "name" => "برگه ها",
                "link" => route("admin_list_page"),
                "icon" => "fa-file",
                "children"=>[
                    ["name"=>"لیست برگه ها","link"=>route("admin_list_page")],
                //    ["name"=>"افزودن برگه جدید","link"=>route("admin_add_page")],
                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_PAGE
            ]);

            config()->set("AdminSidebar.log",[
                "name" => "خطاها",
                "link" => route("log.index"),
                "icon" => "fa-file",
                "children"=>[
                    ["name"=>"لیست خطاها","link"=>route("log.index")],
                    //    ["name"=>"افزودن برگه جدید","link"=>route("admin_add_page")],
                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_PAGE
            ]);
        });

    }
}

