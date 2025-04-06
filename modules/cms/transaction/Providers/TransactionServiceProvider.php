<?php

namespace CMS\Transaction\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Comment\Models\Comment;
use CMS\Comment\policies\CommentPolicy;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/transaction_route.php");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
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
