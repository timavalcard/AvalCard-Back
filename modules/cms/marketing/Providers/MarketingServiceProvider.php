<?php



namespace CMS\Marketing\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\policies\CommentPolicy;
use CMS\Marketing\Repository\AffiliateRepository;
use CMS\Marketing\Services\AffiliateService;
use CMS\RolePermissions\Models\Permission;
use CMS\User\Repositories\UserRepository;

class MarketingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/marketing_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Marketing");
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
        /*$this->app->booted(function (){
            config()->set("AdminSidebar.marketing",[
                "name" => "بازاریابی",
                "link" => route("admin_marketing"),
                "icon" => "fa-bullhorn",
                "children"=>[
                    ["name"=>"بازاریابان","link"=>route("admin_marketing")],
                    ["name"=>"بازاریابان منتظر تایید","link"=>route("admin_marketing_wait")],
                    ["name"=>"درخواست های تسویه","link"=>route("settlement.index")],
                    ["name"=>"تنظیمات","link"=>route("admin_marketing_setting")],
                ],
                "permission"=>Permission::PERMISSION_SUPER_ADMIN

            ]);
        });*/


        view()->composer("Theme::hidi.affiliate.master", function ($view) {
            $setting=AffiliateService::get_setting();
            $entrances=AffiliateRepository::get_affiliate_all_entrance();
            $bank_cart_number=UserRepository::get_meta("bank_cart_number");
            $view->with([
                "entrances"=>$entrances,
                "bank_cart_number"=>$bank_cart_number,
                "setting"=>$setting
            ]);
        });

    }
}
