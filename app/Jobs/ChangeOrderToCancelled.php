<?php

namespace App\Jobs;
use CMS\Order\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;

class ChangeOrderToCancelled implements ShouldQueue
{
    use Queueable;
    /**

     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subHour(2))
            ->whereIn('order_type', ['gift_cart', 'inter_payment',"buy_product"])
            ->get();

        foreach ($orders as $order) {
            $order->status = 'cancelled';
            $order->save();
        }
    }
}
