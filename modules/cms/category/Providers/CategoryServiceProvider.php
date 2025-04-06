<?php

namespace CMS\Category\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Category\Models\Category;
use CMS\Category\policies\CategoryPolicy;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Category");
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
        $this->loadRoutesFrom(__DIR__ . "/../routes/category_routes.php");

        if(Schema::hasTable('category')) {
            config()->set("MenuItem.items.دسته ها", ["items" => Category::get(), "type" => "category"]);
            Gate::policy(Category::class,CategoryPolicy::class);
        }
    }
}
