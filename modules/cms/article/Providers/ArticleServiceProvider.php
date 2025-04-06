<?php

namespace CMS\Article\Providers;

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

        $this->loadRoutesFrom(__DIR__."/../Routes/article_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Article");
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


        if(Schema::hasTable('articles')){
        Gate::policy(Article::class,ArticlePolicy::class);
        config()->set("MenuItem.items.نوشته ها",["items"=>Article::get(),"type"=>"article"]);

        }
        if(Schema::hasTable('category')){
        Category::$post_type[]="article";

        }
        if(Schema::hasTable('category')){
            Tag::$post_type[]="article";

        }

        $this->app->booted(function (){
            config()->set("AdminSidebar.article",[
                "name" => "مقاله ها",
                "link" => route("admin_article_list"),
                "icon" => "fa-newspaper-o",
                "children"=>[
                    ["name"=>"لیست مقالات","link"=>route("admin_article_list")],
                    ["name"=>"افزودن مقاله جدید","link"=>route("admin_article_add")],
                    ["name"=>"دسته بندی ها","link"=>route("admin_add_category",['post_type' => 'article'])],
                    ["name"=>"برچسب ها","link"=>route("admin_add_tag",['post_type' => 'article']) ],
                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_Article
            ]);
        });

    }
}
