<?php

namespace CMS\ProductAttr\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CMS\ProductAttr\Models\Attribute;
use CMS\ProductAttr\policies\ProductAttributePolicy;

class ProductAttrServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Gate::policy(Attribute::class,ProductAttributePolicy::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/attribute_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","ProductAttr");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
    }
}
