<?php

namespace CMS\Settlement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use CMS\OrderService\Models\OrderService;
use CMS\OrderService\Repositories\OrderServiceRepo;

class AddAmountSellerListener
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
            if(isset($event->Settlement->Settlementable->meta["factor"])){
                $order_factor=$event->Settlement->Settlementable->meta["factor"];
                $expert_percent_price=0;
                $team_leader_percent_price=0;
                $team_leader=$event->Settlement->Settlementable->team_leader;
                $expert=$event->Settlement->Settlementable->expert;

                foreach ($order_factor as $factor_item) {
                    $factor_item_price=$factor_item["amount"];
                    if($factor_item["expert_percent"] > 0){
                        $expert_percent_price+=(int) floor(($factor_item["expert_percent"] / 100) * $factor_item_price);
                    }

                    if($factor_item["team_leader_percent"] > 0){
                        $team_leader_percent_price+=(int) floor(($factor_item["team_leader_percent"] / 100) * $factor_item_price);
                    }
                }

                if($team_leader && $team_leader_percent_price > 0){
                    $team_leader->amount += $team_leader_percent_price ;
                    $team_leader->save();
                }
                if($expert && $expert_percent_price > 0){
                    $expert->amount += $expert_percent_price ;
                    $expert->save();
                }
            }

        }
    }
}
