<?php

namespace CMS\Tag\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CMS\Tag\policies\TagPolicy;
use CMS\Tag\Models\Tag;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/tag_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Tag");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        $this->loadFactoriesFrom(__DIR__."/../Database/factories");

        Gate::policy(Tag::class, TagPolicy::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {



    }
}
