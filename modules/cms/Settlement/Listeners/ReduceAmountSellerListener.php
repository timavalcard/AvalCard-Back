<?php

namespace CMS\Settlement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use CMS\OrderService\Models\OrderService;
use CMS\OrderService\Repositories\OrderServiceRepo;

class ReduceAmountSellerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function handle($event)
    {
        if (!is_null($event->Settlement->seller)){


           // $event->Settlement->seller->amount -= $event->Settlement->site_Share ;
           // $event->Settlement->seller->save();
        }
    }
}
