<?php



namespace CMS\Wallet\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;
use CMS\RolePermissions\Models\Permission;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/wallet_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Wallet");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
        $this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function (){
        config()->set("AdminSidebar.wallet",[
            "name" => "کیف پول",
            "link" => route("admin_wallet_index"),
            "icon" => "fa-money",
            "children"=>[
                ["name"=>"کیف پول کاربران","link"=>route("admin_wallet_index")],
                ["name"=>"تراکنش ها","link"=>route("admin_wallet_transactions")],
            ],
            "permission"=>Permission::PERMISSION_SUPER_ADMIN
        ]);
    });
    }
}
