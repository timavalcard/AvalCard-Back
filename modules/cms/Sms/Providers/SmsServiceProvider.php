<?php
namespace CMS\Sms\Providers;


class SmsServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations/");
        $this->mergeConfigFrom(__DIR__.'/../Config/sms.php','Sms');

    }

    public function boot(){

    }
}
