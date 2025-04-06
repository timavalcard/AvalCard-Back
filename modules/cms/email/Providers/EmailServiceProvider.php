<?php



namespace CMS\Email\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;
use CMS\Shop\Repository\ShopRepository;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/email_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Email");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
      //  $this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('shop_setting')) {
            config(["mail.mailers.smtp.host" => ShopRepository::getOption("server_name")]);
            config(["mail.mailers.smtp.port" => ShopRepository::getOption("server_port")]);
            config(["mail.mailers.smtp.username" => ShopRepository::getOption("email_username")]);
            config(["mail.mailers.smtp.password" => ShopRepository::getOption("email_password")]);
            config(["mail.mailers.smtp.encryption" => ShopRepository::getOption("email_encryption")]);

            config(["mail.from.address" => ShopRepository::getOption("sender_email")]);
            config(["mail.from.name" => ShopRepository::getOption("sender_name")]);
        }
    }
}
