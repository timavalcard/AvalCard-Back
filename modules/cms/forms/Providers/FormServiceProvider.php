<?php



namespace CMS\Forms\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/forms_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Forms");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");

       // $this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function (){
            config()->set("AdminSidebar.forms",[
                "name" => "فرم ها",
                "link" => route("admin_list_forms"),
                "icon" => "fa-wpforms",
                "children"=>[
                    ["name"=>"لیست فرم","link"=>route("admin_list_forms")],
                    ["name"=>"افزودن فرم جدید","link"=>route("admin_create_form")],
                ],
            ]);
        });
    }
}
