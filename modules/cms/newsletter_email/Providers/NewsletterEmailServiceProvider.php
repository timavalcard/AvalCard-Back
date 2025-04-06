<?php
namespace CMS\NewsletterEmail\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CMS\NewsletterEmail\Models\Newsletter_mail;
use CMS\NewsletterEmail\policies\NewsletterEmailPolicy;

class NewsletterEmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/newsletter_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","NewsletterEmail");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
       // $this->loadFactoriesFrom(__DIR__."/../Database/factories");
        Gate::policy(Newsletter_mail::class,NewsletterEmailPolicy::class);
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
