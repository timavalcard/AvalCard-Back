<?php

namespace CMS\Settlement\Providers;

use Illuminate\Support\Facades\Gate;
use CMS\Settlement\Models\Settlement;
use CMS\Settlement\Policies\SettlementPolicy;

class SettlementServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../Routes/settlement_routes.php");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations/");
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/','Settlement');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang/');
//        DatabaseSeeder::$Seeders[] = SettlementSeeder::class;
        Gate::policy(Settlement::class,SettlementPolicy::class);

    }

    public function boot(){


    }
}
