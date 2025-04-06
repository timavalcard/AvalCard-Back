<?php

namespace CMS\Comment\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\Models\Comment;
use CMS\Comment\policies\CommentPolicy;
use CMS\RolePermissions\Models\Permission;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/comment_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Comment");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
       // $this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('comments')) {
            Gate::policy(Comment::class, CommentPolicy::class);
        }
        $this->app->booted(function (){
            config()->set("AdminSidebar.comments",[
                "name" => "مدیریت نظرات",
                "link" => route("article_comments.index"),
                "icon" => "fa-comments",
                "children"=>[
                    ["name"=>"لیست نظرات مقالات","link"=>route("article_comments.index")],
                    ["name"=>"لیست نظرات محصولات","link"=>route("product_comments.index")],
                    ["name"=>"پرسش و پاسخ محصولات","link"=>route("product_questions.index")],

                ],
                "permission"=>Permission::PERMISSION_SUPER_ADMIN
            ]);
        });
    }
}
