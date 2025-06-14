<?php
namespace CMS\Newsletter\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CMS\Newsletter\Models\Newsletter;
use CMS\Newsletter\policies\NewsletterPolicy;

class NewsletterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/newsletter_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Newsletter");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
       // $this->loadFactoriesFrom(__DIR__."/../Database/factories");
        Gate::policy(Newsletter::class,NewsletterPolicy::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function (){
        config()->set("AdminSidebar.newsletter",[
            "name" => "خبرنامه",
            "link" => route("admin_newsletter_list"),
            "icon" => "fa-envelope",
            "children"=>[
                ["name"=>"ارسال یک پیام جدید","link"=>route("admin_newsletter_add")],
                ["name"=>"ایمیل های کاربران","link"=>route("admin_newsletter_list")],
                ["name"=>"پیام های ارسال شده","link"=>route("admin_newsletter_list_sent")],
            ],
            "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_NEWSLETTER
        ]);
    });
    }
}
