<?php

namespace API\Article\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Article\Models\Article;
use CMS\Article\policies\ArticlePolicy;
use CMS\Category\Models\Category;
use CMS\Tag\Models\Tag;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->loadRoutesFrom(__DIR__."/../Routes/api.php");
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
