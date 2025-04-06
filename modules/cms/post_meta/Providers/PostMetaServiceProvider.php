<?php

namespace CMS\PostMeta\Providers;

use Illuminate\Support\ServiceProvider;


class PostMetaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
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
