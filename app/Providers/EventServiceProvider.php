<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use CMS\Cart\Events\AfterLoginAndRegisterAddCartToDatabaseEvent;
use CMS\Course\Listeners\RegisterUserInTheCourse;
use CMS\Order\Listeners\transaction_add_order_listener;
use CMS\Transaction\Events\TransactionSucceed;
use CMS\Transaction\Models\Transaction;
use CMS\Wallet\Listeners\transaction_increase_wallet_listener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AfterLoginAndRegisterAddCartToDatabaseEvent::class
        ],
        Login::class=> [
            AfterLoginAndRegisterAddCartToDatabaseEvent::class
        ],
        TransactionSucceed::class=>[
            transaction_add_order_listener::class,
            transaction_increase_wallet_listener::class,
            RegisterUserInTheCourse::class
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
