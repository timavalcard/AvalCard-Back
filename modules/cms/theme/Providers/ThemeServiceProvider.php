<?php
namespace CMS\Theme\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Comment\policies\CommentPolicy;
use CMS\Course\Services\CourseService;
use CMS\Menu\Repository\MenuRepository;
use CMS\Product\Service\ProductService;
use CMS\Shop\Service\ShopService;
use CMS\Theme\Http\Controllers\ThemeController;
use CMS\ThemeSetting\Repository\ThemeSettingRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Repository\WalletRepository;
use CMS\Wallet\Services\WalletService;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->loadRoutesFrom(__DIR__ . "/../routes/theme_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Theme");
        $this->mergeConfigFrom(__DIR__."/../config/theme_config.php","theme");
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



    }
}
