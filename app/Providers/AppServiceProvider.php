<?php

namespace App\Providers;

use CMS\Order\Models\Order;
use CMS\Page\Models\Page;
use CMS\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Article\Models\Article;
use CMS\Wallet\Models\Wallet;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        Relation::morphMap([
            'article' => Article::class,
            'page' => Page::class,
            'product' => Product::class,
            'order' => Order::class,
            'wallet' => Wallet::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
