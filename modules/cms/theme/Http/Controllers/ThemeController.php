<?php

namespace CMS\Theme\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Common\Services\CommonService;
use CMS\Marketing\Services\AffiliateService;
use CMS\Order\Models\Order;
use CMS\Page\Repository\PageRepository;
use CMS\Page\Services\CreateService;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\RolePermissions\Models\Role;
use CMS\ThemeSetting\Repository\ThemeSettingRepository;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Models\User;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;


class ThemeController extends Controller
{

    public function index(){

        if(!\auth()->check()){

            return redirect(route("auth.index"));
        } else{
            if(\auth()->user()->hasRole(\CMS\RolePermissions\Models\Role::ROLE_USER)){
                \auth()->logout();
                return redirect(route("auth.index"));
            } else{
                return redirect(route("admin.dashboard"));

            }
        };
    }
}
