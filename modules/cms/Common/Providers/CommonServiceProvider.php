<?php

namespace CMS\Common\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Category\Models\Category;
use CMS\Comment\Models\Comment;
use CMS\Comment\policies\CommentPolicy;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Common");
       $this->mergeConfigFrom(__DIR__."/../config/admin-sidebar.php","AdminSidebar");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Category::$post_type[]="course";
    }
}
